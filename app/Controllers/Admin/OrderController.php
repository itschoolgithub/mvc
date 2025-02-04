<?php
namespace App\Controllers\Admin;

use App\Core\Authorization;
use App\Core\Controller;
use App\Core\Redirect;
use App\Models\OrderModel;
use App\Models\UserModel;
use App\Views\AdminOrderView;

class OrderController extends Controller
{
    public function __construct()
    {
        Redirect::redirectIfIsNotAdmin('/');
        $this->model = new OrderModel;
        $this->view  = new AdminOrderView;
    }

    public function indexAction(): void
    {
        $orders = $this->model->all();
        $this->view->html('index', ['orders' => $orders]);
    }

    public function createAction(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // здесь бы хорошо проверить переданные данные
            $this->model->create($_POST);

            $_SESSION['success'] = 'Заказ успешно создан!';
            Redirect::redirect('/admin/order');
        } else {
            $userModel = new UserModel;
            $users = $userModel->all();
            $this->view->html('create', ['users' => $users]);
        }
    }

    public function editAction(): void
    {
        $this->requireItem();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // здесь бы хорошо проверить переданные данные
            $_POST['id'] = $this->item['id'];
            $this->model->update($_POST);

            $_SESSION['success'] = 'Заказ успешно изменен!';
            Redirect::redirect('/admin/order');
        } else {
            $userModel = new UserModel;
            $users = $userModel->all();

            $this->view->html('edit', ['order' => $this->item, 'users' => $users]);
        }
    }

    public function deleteAction(): void
    {
        $this->requireItem();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->delete($this->item['id']);

            $_SESSION['success'] = 'Заказ успешно удален!';
            Redirect::redirect('/admin/order');
        } else {
            $this->view->html('delete', ['order' => $this->item]);
        }
    }
}
