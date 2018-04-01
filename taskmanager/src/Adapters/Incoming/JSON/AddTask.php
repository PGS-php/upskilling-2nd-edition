<?php

namespace App\Adapters\Incoming\JSON;

use App\Domain\Ports\DTO\NewTask;
use App\Domain\Process\TaskService;

class AddTask implements \App\Domain\Ports\Incoming\AddTask
{
    /** @var TaskService */
    private $taskService;

    /**
     * AddTask constructor.
     * @param $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function addTask($data)
    {
        $data = json_decode($data, true);

        $task = new NewTask();
        $task->name = $data['name'];
        $task->user = $data['user'];
        $task->status = $data['status'];
        $task->priority = $data['priority'];

        $this->taskService->addTask($task);
    }
}