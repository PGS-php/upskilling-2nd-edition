<?php

namespace App\Application\Query;

use App\Domain\Ports\Outgoing\TaskRepository;

class AllTasksQueryHandler
{
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function handle(AllTasksQuery $allTasksQuery)
    {
        return $this->taskRepository->getAll();
    }
}