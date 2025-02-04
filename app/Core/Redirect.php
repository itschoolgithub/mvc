<?php
namespace App\Core;

class Redirect
{
    /**
     * Простой редирект
     */
    public static function redirect($url)
    {
        header('Location: ' . $url);
        die();
    }

    /**
     * Редирект если пользователь авторизован
     */
    public static function redirectIfAuth($url)
    {
        if (Authorization::isAuth()) {
            $_SESSION['info'] = 'Вы уже авторизованы';
            self::redirect($url);
        }
    }

    /**
     * Редирект если пользователь не авторизован
     */
    public static function redirectIfNotAuth($url)
    {
        if (!Authorization::isAuth()) {
            $_SESSION['info'] = 'Вы не авторизованы';
            self::redirect($url);
        }
    }

    /**
     * Редирект если пользователь не админ
     */
    public static function redirectIfIsNotAdmin($url)
    {
        if (!Authorization::isAdmin()) {
            $_SESSION['danger'] = 'У вас нет прав';
            self::redirect($url);
        }
    }
}
