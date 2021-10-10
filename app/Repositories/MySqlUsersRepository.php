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
        $user = DB_USERNAME;
        $pass = DB_PASSWORD;

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
        try {
            $this->connection = new \PDO($dsn, $user, $pass);
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
            hash('sha512', $user->getPassword())
        ]);
    }

    public function find(): void
    {
        $sql = "SELECT * FROM users WHERE username = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$_POST['username']]);

        if ($statement->rowCount() !== 1) header('Location: /login');

        $inputPwd = hash('sha512', $_POST['pwd']);
        $hash = $statement->fetchColumn(3);

        if ($inputPwd === $hash) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['email'] = "email";
            require_once 'app/Views/Users/account.template.php';
        } else {
            header('Location: /login');
        }
    }
}