<?php

namespace App\Repositories;

use App\Models\User;
use PDO;

require_once 'config.php';

class MySqlUsersRepository implements UsersRepository
{

    private PDO $connection;

    public function __construct()
    {
        $host = DB_HOST;
        $db = DB_DATABASE;
        $db_user = DB_USERNAME;
        $pass = DB_PASSWORD;

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
        try {
            $this->connection = new \PDO($dsn, $db_user, $pass);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function add(User $user): void
    {
        $sql = "INSERT INTO users (id, username, email, password) VALUES (?, ?, ?, ?)";
        $statement = $this->connection->prepare($sql);
        $statement->execute([
            $user->getId(),
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword()
        ]);
    }

    public function find(string $username): ?User
    {
        $sql = "SELECT * FROM users WHERE username = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$username]);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($user)) return null;

        return new User(
            $user['id'],
            $user['username'],
            $user['email'],
            $user['password']
        );
    }
}