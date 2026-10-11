<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;

class TaskService
{
    public function createTask(User $user, array $data): Task
    {
        return $user->tasks()->create($data);
    }
}
