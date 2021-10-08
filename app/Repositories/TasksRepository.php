<?php

namespace App\Repositories;

use App\Models\Collections\TasksCollection;
use App\Models\Task;

interface TasksRepository
{
    public function getAll(): TasksCollection;
    public function getOne(string $id): ?Task;
    public function add(Task $task): void;
    public function delete(Task $task): void;
}
