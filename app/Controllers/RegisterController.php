<?php
namespace App\Controllers;

use App\Core\Authorization;
use App\Core\Controller;
use App\Core\Redirect;
use App\Views\AuthView;

class RegisterController extends Controller
{
    public function __construct()
    {
        // $this->model = new OrderModel;
        $this->view = new AuthView;
    }

    /**
     * Главное действие
     */
    public function indexAction(): void
    {
        // Не пускать авторизованных
        Redirect::redirectIfAuth('/');

        // Выбираем каким методом был получен доступ к странице
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Регистрируем пользователя
            $this->register();
        } else {
            // Отображаем форму регистрации
            $this->showForm();
        }
    }

    /**
     * Отображение формы
     */
    public function showForm(): void
    {
        // из сессии сохраненные данные формы размещаем в POST
        $_POST = $_SESSION['request'] ?? [];
        // удаляем их из сессии
        unset($_SESSION['request']);
        $this->view->html('register');
    }

    public function register(): void
    {
        // Пытаемся зарегистрировать пользователя
        $result = Authorization::tryRegister($_POST['login'], $_POST['password']);

        if ($result['success']) {
            // если успешно, сохраняем флэш сообщение
            $_SESSION['success'] = $result['message'];
            // кидаем пользователя на главную страницу
            Redirect::redirect('/');
        } else {
            $_SESSION['danger'] = $result['message'];
            // сохраняем в сессию переданные данные
            $_SESSION['request'] = $_POST;
            // снова кидаем пользователя на страницу регистрации
            Redirect::redirect('/register');
        }
    }
}
