<?php
namespace App\Core;

class Authorization
{
    /**
     * Попытка авторизовать пользователя по переданным логину и паролю
     */
    public static function tryAuth(string $login, string $password): array
    {
        // ищем пользователя с таким логином
        $user = self::getUserByLogin($login);

        if (!self::checkUser($user)) {
            return ['success' => false, 'message' => 'Пользователь не существует'];
        }

        // проверяем что сохраненный хэш пароля совпадает с хэшом полученным из переданного пароля
        if (password_verify($password, $user['password'])) {
            // если да, то авторизовываем пользователя
            self::saveInSession($user['id']);
            return ['success' => true, 'message' => 'Успешный вход!'];
        }

        return ['success' => false, 'message' => 'Пароль не верный'];
    }

    /**
     * Попытка зарегистрировать пользователя по переданным логину и паролю
     */
    public static function tryRegister(string $login, string $password): array
    {
        // ищем пользователя с таким логином
        $user = self::getUserByLogin($login);

        if (self::checkUser($user)) {
            return ['success' => false, 'message' => 'Пользователь уже существует'];
        }

        // Создание пользователя в БД
        self::createUser($login, $password);

        $user = self::getUserByLogin($login);

        if (!self::checkUser($user)) {
            return ['success' => false, 'message' => 'Произошла ошибка создания пользователя'];
        }

        self::saveInSession($user['id']);
        return ['success' => true, 'message' => 'Успешная регистрация!'];
    }

    /**
     * Получаем из БД пользователя по его логину
     */
    public static function getUserByLogin(string $login): array | bool
    {
        $database = new DB;
        $sql      = "SELECT * FROM users WHERE login = ?";
        return $database->get($sql, [$login]);
    }

    /**
     * Получаем из БД пользователя по его айдишнику
     */
    public static function getUserByID(int $id): array | bool
    {
        $database = new DB;
        $sql      = "SELECT * FROM users WHERE id = ?";
        return $database->get($sql, [$id]);
    }

    /**
     * Создание нового пользователя в БД
     */
    public static function createUser(string $login, string $password): void
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $database = new DB;
        $sql      = "INSERT INTO users (login, password) VALUES (?, ?)";
        $database->query($sql, [$login, $hash]);
    }

    /**
     * Проверяем что пользователь найден
     */
    public static function checkUser(array | bool $user): bool
    {
        return !!$user;
    }

    /**
     * Получаем айдишники текущего авторизованного пользователя
     */
    public static function getCurrentUserID(): int
    {
        return $_SESSION['user_id'] ?? 0;
    }

    /**
     * Получаем текущего авторизованного пользователя
     */
    public static function getCurrentUser(): array | bool
    {
        // берем сохраненный айдишник из сессии
        $currentUserID = self::getCurrentUserID();
        if ($currentUserID) {
            // ищем пользователя с таким айди
            return self::getUserByID($currentUserID);
        }
        return false;
    }

    /**
     * Проверка авторизован ли пользователь
     */
    public static function isAuth(): bool
    {
        $user = self::getCurrentUser();
        return !!$user;
    }

    /**
     * Проверка админ ли пользователь
     */
    public static function isAdmin(): bool
    {
        $user = self::getCurrentUser();
        if ($user) {
            return $user['is_admin'];
        }
        return false;
    }

    /**
     * Сохранение авторизации в сессию
     */
    public static function saveInSession(int $id): void
    {
        $_SESSION['user_id'] = $id;
    }

    /**
     * Выйти из аккаунта
     */
    public static function logout(): void
    {
        session_destroy();
    }
}
