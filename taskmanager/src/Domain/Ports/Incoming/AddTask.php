<?php

namespace App\Domain\Ports\Incoming;

use App\Domain\Ports\DTO\NewTask;

interface AddTask
{
    public function addTask(NewTask $task);
}