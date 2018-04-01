<?php declare(strict_types=1);

namespace App\Infrastructure\Adapters\Outgoing\InMemory;

use App\Domain\Task\Status;
use App\Domain\Task\Task;
use App\Domain\User\User;

class TaskRepository implements \App\Domain\Ports\Outgoing\TaskRepository
{
    private $tasks = [];

    public function getAll(): array
    {
        return $this->tasks;
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

    public function add(Task $task)
    {
        $this->tasks[(string)$task->getId()] = $task;
    }

    public function changeAssignee(Task $task, User $user)
    {
        // TODO: Implement changeAssignee() method.
    }

    public function changeStatus(Task $task, Status $status)
    {
        // TODO: Implement changeStatus() method.
    }

    public function remove(Task $task): void
    {
        unset($this->tasks[(string)$task->getId()]);
    }
}
