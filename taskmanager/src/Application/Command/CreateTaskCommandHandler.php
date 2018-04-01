<?php

namespace App\Application\Command;

use App\Domain\Ports\Incoming\AddTask;

class CreateTaskCommandHandler
{
    private $addTask;

    public function __construct(AddTask $addTask)
    {
        $this->addTask = $addTask;
    }

    public function handle(CreateTaskCommand $createTaskCommand)
    {
        $this->addTask->addTask($createTaskCommand->getData());
    }
}