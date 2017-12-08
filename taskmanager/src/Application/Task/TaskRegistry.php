<?php declare(strict_types=1);

namespace App\Application\Task;

interface TaskRegistry
{
    /**
     * @return array|Task[]
     */
    public function getAll(): array;

    public function add(Task $task): void;

    public function getByStatus(Status $status): array;
}
