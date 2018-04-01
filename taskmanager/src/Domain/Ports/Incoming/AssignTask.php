<?php

namespace App\Domain\Ports\Incoming;

use App\Domain\Task\Task;
use App\Domain\User\User;

interface AssignTask
{
    public function assign(Task $task, User $user);
}