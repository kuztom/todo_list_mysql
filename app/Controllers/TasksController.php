<?php

namespace App\Controllers;

use App\Models\Task;
use App\Repositories\CsvTasksRepository;
use App\Repositories\MySqlTasksRepository;
use App\Repositories\TasksRepository;
use Ramsey\Uuid\Uuid;

class TasksController
{
    private TasksRepository $tasksRepository;

    public function __construct()
    {
        $this->tasksRepository = new MySqlTasksRepository();
    }

    public function index()
    {
        $tasks = $this->tasksRepository->getAll();

        require_once 'app/Views/index.template.php';
    }

    public function open(array $vars)
    {
        $id = $vars['id'] ?? null;

        if ($id == null) header('Location: /');

        $task = $this->tasksRepository->getOne($id);

        if ($task === null) header('Location: /');

        require_once 'app/Views/task.template.php';
    }

    public function new()
    {
        require_once 'app/Views/newtask.template.php';
    }

    public function save()
    {
        $task = new Task(Uuid::uuid1(), $_POST['date'], $_POST['task']);

        $this->tasksRepository->add($task);

        header('Location: /');
    }

    public function delete(array $vars)
    {

        $id = $vars['id'] ?? null;

        if ($id == null) header('Location: /');

        $task = $this->tasksRepository->getOne($id);


        if ($task !== null) {
            $this->tasksRepository->delete($task);
        }
        header('Location: /');
    }

}