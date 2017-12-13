<?php declare(strict_types=1);

namespace App\Infrastructure\InMemory;

use App\Application\Task\Status;
use App\Application\Task\Task;
use App\Application\Task\TaskRegistry as BaseTaskRegistry;

class TaskRegistry implements BaseTaskRegistry
{
    private $tasks = [];

    /**
     * @inheritdoc
     */
    public function getAll(): array
    {
        return $this->tasks;
    }

    public function add(Task $task): void
    {
        $this->tasks[(string)$task->getId()] = $task;
    }

    public function getByStatus(Status $status): array
    {
        return array_filter($this->tasks, function (Task $task) use ($status) {
            return $status->equals($task->getStatus());
        });
    }

    public function getByName(string $name): array
    {
        return array_filter($this->tasks, function (Task $task) use ($name) {
            return $name === $task->getName();
        });
    }
}
