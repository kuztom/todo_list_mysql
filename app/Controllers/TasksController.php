<?php

namespace App\Controllers;

use App\Models\Task;
use App\Repositories\CsvTasksRepository;
use App\Repositories\MySqlTasksRepository;
use App\Repositories\TasksRepository;
use App\ViewRender;
use Ramsey\Uuid\Uuid;

class TasksController
{
    private TasksRepository $tasksRepository;

    public function __construct()
    {
        $this->tasksRepository = new MySqlTasksRepository();
    }

    public function index(): ViewRender
    {
        $tasks = $this->tasksRepository->getAll();

        return new ViewRender('index.twig', [
            'tasks' => $tasks
        ]);

    }

    public function open(array $vars)
    {
        $id = $vars['id'] ?? null;

        if ($id == null) header('Location: /');

        $task = $this->tasksRepository->getOne($id);

        if ($task === null) header('Location: /');

        return new ViewRender('task.twig', [
            'task' => $task
        ]);
    }

    public function new()
    {

        return new ViewRender('newtask.twig');
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