<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Redirect;
use App\Models\ApplicationModel;
use App\Models\OrderModel;
use App\Models\UserModel;
use App\Views\AdminApplicationView;

class ApplicationController extends Controller
{
    public function __construct()
    {
        Redirect::redirectIfIsNotAdmin('/');
        $this->model = new ApplicationModel;
        $this->view  = new AdminApplicationView;
    }

    public function indexAction(): void
    {
        $applications = $this->model->all();
        $this->view->html('index', ['applications' => $applications]);
    }

    public function createAction(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // здесь бы хорошо проверить переданные данные
            $this->model->create($_POST);

            $_SESSION['success'] = 'Отклик успешно создан!';
            Redirect::redirect('/admin/application');
        } else {
            $userModel = new UserModel;
            $users = $userModel->all();

            $orderModel = new OrderModel;
            $orders = $orderModel->all();

            $this->view->html('create', ['users' => $users, 'orders' => $orders]);
        }
    }

    public function editAction(): void
    {
        $this->requireItem();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // здесь бы хорошо проверить переданные данные
            $_POST['id'] = $this->item['id'];
            $this->model->update($_POST);

            $_SESSION['success'] = 'Отклик успешно изменен!';
            Redirect::redirect('/admin/application');
        } else {
            $userModel = new UserModel;
            $users = $userModel->all();

            $orderModel = new OrderModel;
            $orders = $orderModel->all();

            $this->view->html('edit', [
                'application' => $this->item,
                'users' => $users,
                'orders' => $orders
            ]);
        }
    }

    public function deleteAction(): void
    {
        $this->requireItem();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->delete($this->item['id']);

            $_SESSION['success'] = 'Отклик успешно удален!';
            Redirect::redirect('/admin/application');
        } else {
            $this->view->html('delete', ['application' => $this->item]);
        }
    }
}
