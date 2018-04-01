<?php

namespace App\Domain\Ports\Incoming;

use App\Domain\Process\Task\Status;
use App\Domain\Process\Task\Task;
use App\Domain\Process\User\User;

interface ChangeStatus
{
    public function change(Task $task, Status $status, User $user);
}