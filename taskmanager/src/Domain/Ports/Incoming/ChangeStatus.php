<?php

namespace App\Domain\Ports\Incoming;

use App\Domain\Task\Status;
use App\Domain\Task\Task;
use App\Domain\User\User;

interface ChangeStatus
{
    public function change(Task $task, Status $status, User $user);
}