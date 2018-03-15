<?php

namespace App\Domain\Ports\Outgoing;

use App\Domain\Process\Task\Status;
use App\Domain\Process\Task\Task;
use App\Domain\Process\User\User;

interface TaskRepository
{
    public function saveTask(Task $task);

    public function changeAssignee(Task $task, User $user);

    public function changeStatus(Task $task, Status $status);
}