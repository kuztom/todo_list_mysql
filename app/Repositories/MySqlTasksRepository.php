<?php

namespace App\Repositories;

use App\Models\Collections\TasksCollection;
use App\Models\Task;
use PDO;

include 'config.php';

class MySqlTasksRepository implements TasksRepository
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

    public function getAll(): TasksCollection
    {
        $sql = "SELECT * FROM tasks ORDER by date";
        $statement = $this->connection->query($sql);
        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
        $collection = new TasksCollection();

        foreach ($tasks as $task) {
            $collection->add(new Task(
                $task['id'],
                $task['date'],
                $task['title'],
                $task['status'],
            ));
        }

        return $collection;
    }

    public function getOne(string $id): ?Task
    {
        $sql = "SELECT * FROM tasks WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);
        $task = $statement->fetch();

        return new Task(
            $task['id'],
            $task['date'],
            $task['title'],
            $task['status']
        );
    }

    public function add(Task $task): void
    {
        $sql = "INSERT INTO tasks (id, date, title, status) VALUES (?, ?, ?, ?)";
        $statement = $this->connection->prepare($sql);
        $statement->execute([
            $task->getId(),
            $task->getDate(),
            $task->getTitle(),
            $task->getStatus()
        ]);
    }

    public function delete(Task $task): void
    {
        $sql = "DELETE FROM tasks WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$task->getId()]);
    }
}