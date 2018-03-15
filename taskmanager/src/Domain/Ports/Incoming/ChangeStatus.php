<?php

namespace App\Domain\Ports\Incoming;

use App\Domain\Process\Task\Status;
use App\Domain\Process\Task\Task;

interface ChangeStatus
{
    public function change(Task $task, Status $status);
}