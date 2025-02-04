<?php
namespace App\Controllers;

use App\Core\Authorization;
use App\Core\Controller;
use App\Core\Redirect;
use App\Models\ApplicationModel;
use App\Models\OrderModel;
use App\Views\OrderView;

if (!defined('MVC')) {
    die();
}

class OrderController extends Controller
{
    public function __construct()
    {
        $this->model = new OrderModel;
        $this->view  = new OrderView;
    }

    public function indexAction(): void
    {
        $orders = $this->model->all();
        $this->view->html('index', ['orders' => $orders]);
    }

    public function createAction(): void
    {
        Redirect::redirectIfNotAuth('/login');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // здесь бы хорошо проверить переданные данные
            $_POST['user_id'] = Authorization::getCurrentUserID();
            $this->model->create($_POST);

            $_SESSION['success'] = 'Заказ успешно создан!';
            Redirect::redirect('/order');
        } else {
            $this->view->html('create');
        }
    }

    public function showAction(): void
    {
        $this->requireItem();
        $applicationModel = new ApplicationModel;
        $applications = $applicationModel->whereOrderID($this->item['id']);

        $this->view->html('show', [
            'order' => $this->item,
            'applications' => $applications,
            'has_permision' => $this->model->hasPermision($this->item),
        ]);
    }

    public function editAction(): void
    {
        Redirect::redirectIfNotAuth('/login');
        $this->requireItem();

        if (!$this->model->hasPermision($this->item)) {
            $_SESSION['danger'] = 'У вас нет прав на редактирование';
            Redirect::redirect('/order');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // здесь бы хорошо проверить переданные данные
            $_POST['id'] = $this->item['id'];
            $_POST['user_id'] = Authorization::getCurrentUserID();
            $this->model->update($_POST);

            $_SESSION['success'] = 'Заказ успешно изменен!';
            Redirect::redirect('/order');
        } else {
            $this->view->html('edit', ['order' => $this->item]);
        }
    }

    public function deleteAction(): void
    {
        Redirect::redirectIfNotAuth('/login');
        $this->requireItem();

        if (!$this->model->hasPermision($this->item)) {
            $_SESSION['danger'] = 'У вас нет прав на удаление';
            Redirect::redirect('/order');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->delete($this->item['id']);

            $_SESSION['success'] = 'Заказ успешно удален!';
            Redirect::redirect('/order');
        } else {
            $this->view->html('delete', ['order' => $this->item]);
        }
    }

    public function replyAction(): void
    {
        Redirect::redirectIfNotAuth('/login');
        $this->requireItem();

        if ($this->model->hasPermision($this->item)) {
            $_SESSION['danger'] = 'Нельзя отликаться на свой заказ';
            Redirect::redirect('/order');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // здесь бы хорошо проверить переданные данные
            $applicationModel = new ApplicationModel;
            $applicationModel->create([
                'user_id' => Authorization::getCurrentUserID(),
                'order_id' => $this->item['id']
            ]);

            $_SESSION['success'] = 'Вы успешно откликнулись на заказ!';
            Redirect::redirect('/order/show/' . $this->item['id']);
        } else {
            $this->view->html('reply', ['order' => $this->item]);
        }

    }
}
