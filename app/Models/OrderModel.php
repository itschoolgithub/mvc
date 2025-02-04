<?php
namespace App\Models;

use App\Core\Authorization;
use App\Core\Model;

class OrderModel extends Model {
    public function all(): array {
        // Выборка заказов, со связанными таблицами - пользователи и отклики
        $sql = "SELECT
                o.id, o.title, o.description, o.price, o.user_id, u.login AS user_login, COUNT(a.order_id) AS applications_count
            FROM `orders` AS o
                JOIN `users` AS u ON o.user_id = u.id
                LEFT JOIN applications AS a ON a.order_id = o.id
            GROUP BY o.id";
                // подзапрос внутри скобок группирует заказы по id
        return $this->database->all($sql);
    }

    public function get(int $id): array|bool {
        $sql = 'SELECT
                o.id, o.title, o.description, o.price, o.user_id, u.login AS user_login, COUNT(a.order_id) AS applications_count
            FROM `orders` AS o
                JOIN `users` AS u ON o.user_id = u.id
                LEFT JOIN applications AS a ON a.order_id = o.id
            WHERE o.id = ?
            GROUP BY o.id';
        return $this->database->get($sql, [$id]);
    }

    public function create($data): void {
        $sql = 'INSERT INTO orders(title, description, price, user_id) VALUES (?, ?, ? ,?)';
        $this->database->query($sql, [
            $data['title'],
            $data['description'],
            $data['price'],
            $data['user_id']
        ]);
    }

    public function update($data): void {
        $sql = 'UPDATE `orders` SET `title`= ?,`description`= ?, `price`= ?, `user_id`= ? WHERE id = ?';
        $this->database->query($sql, [
            $data['title'],
            $data['description'],
            $data['price'],
            $data['user_id'],
            $data['id'],
        ]);
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM orders WHERE id = ?';
        $this->database->query($sql, [$id]);
    }

    public function hasPermision(array $item): bool {
        return $item['user_id'] == Authorization::getCurrentUserID();
    }
}