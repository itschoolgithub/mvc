<?php
namespace App\Models;

use App\Core\Model;

class UserModel extends Model
{
    public function all(): array
    {
        $sql = 'SELECT * FROM users';
        return $this->database->all($sql);
    }

    public function get(int $id): array | bool
    {
        $sql = 'SELECT * FROM users WHERE id = ?';
        return $this->database->get($sql, [$id]);
    }

    public function create($data): void {
        $sql = 'INSERT INTO users(login, password, is_admin) VALUES (?, ?, ?)';
        $this->database->query($sql, [
            $data['login'],
            $data['password'],
            $data['is_admin']
        ]);
    }

    public function update($data): void {
        $sql = 'UPDATE `users` SET `login`= ?,`password`= ?, `is_admin`= ? WHERE id = ?';
        $this->database->query($sql, [
            $data['login'],
            $data['password'],
            $data['is_admin'],
            $data['id'],
        ]);
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM users WHERE id = ?';
        $this->database->query($sql, [$id]);
    }
}
