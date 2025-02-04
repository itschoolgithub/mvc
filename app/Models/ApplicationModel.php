<?php
namespace App\Models;

use App\Core\Model;

class ApplicationModel extends Model
{
    public function all(): array
    {
        $sql = "SELECT a.id, a.user_id, a.order_id, u.login AS user_login, o.title AS order_title FROM `applications` AS a JOIN `users` AS u ON a.user_id = u.id JOIN `orders` AS o ON a.order_id = o.id;";
        return $this->database->all($sql);
    }

    public function get(int $id): array | bool
    {
        $sql = 'SELECT * FROM applications WHERE id = ?';
        return $this->database->get($sql, [$id]);
    }

    public function whereOrderID(int $id): array | bool  {
        $sql = 'SELECT a.id, u.login AS user_login
        FROM applications AS a
            JOIN users AS u ON u.id = a.user_id
        WHERE a.order_id = ?';
        return $this->database->all($sql, [$id]);
    }

    public function create($data): void {
        $sql = 'INSERT INTO applications(user_id, order_id) VALUES (?, ?)';
        $this->database->query($sql, [
            $data['user_id'],
            $data['order_id'],
        ]);
    }

    public function update($data): void {
        $sql = 'UPDATE `applications` SET `user_id`= ?,`order_id`= ? WHERE id = ?';
        $this->database->query($sql, [
            $data['user_id'],
            $data['order_id'],
            $data['id'],
        ]);
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM applications WHERE id = ?';
        $this->database->query($sql, [$id]);
    }
}
