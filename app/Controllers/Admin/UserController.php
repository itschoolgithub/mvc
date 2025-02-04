<?php
namespace App\Controllers\Admin;

use App\Core\Authorization;
use App\Core\Controller;
use App\Core\Redirect;
use App\Models\UserModel;
use App\Views\AdminUserView;

class UserController extends Controller
{
    public function __construct()
    {
        Redirect::redirectIfIsNotAdmin('/');
        $this->model = new UserModel;
        $this->view  = new AdminUserView;
    }

    public function indexAction(): void
    {
        $users = $this->model->all();
        $this->view->html('index', ['users' => $users]);
    }

    public function createAction(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // здесь бы хорошо проверить переданные данные
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $_POST['is_admin'] = $_POST['is_admin'] ?? 0;
            $this->model->create($_POST);

            $_SESSION['success'] = 'Пользователь успешно создан!';
            Redirect::redirect('/admin/user');
        } else {
            $this->view->html('create');
        }
    }

    public function editAction(): void
    {
        $this->requireItem();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // здесь бы хорошо проверить переданные данные
            $_POST['id'] = $this->item['id'];
            if (!$_POST['password']) {
                $_POST['password'] = $this->item['password'];
            } else {
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
            $_POST['is_admin'] = $_POST['is_admin'] ?? 0;
            $this->model->update($_POST);

            $_SESSION['success'] = 'Пользователь успешно изменен!';
            Redirect::redirect('/admin/user');
        } else {
            $this->view->html('edit', ['user' => $this->item]);
        }
    }

    public function deleteAction(): void
    {
        $this->requireItem();

        if ($this->item['id'] == Authorization::getCurrentUserID()) {
            $_SESSION['danger'] = 'Нельзя удалять себя!';
            Redirect::redirect('/admin/user');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->delete($this->item['id']);

            $_SESSION['success'] = 'Пользователь успешно удален!';
            Redirect::redirect('/admin/user');
        } else {
            $this->view->html('delete', ['user' => $this->item]);
        }
    }
}
