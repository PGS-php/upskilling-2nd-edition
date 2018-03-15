<?php

namespace App\Domain\Ports\Incoming;

use App\Domain\Process\Task\Task;
use App\Domain\Process\User\User;

interface AssignTask
{
    public function assign(Task $task, User $user);
}