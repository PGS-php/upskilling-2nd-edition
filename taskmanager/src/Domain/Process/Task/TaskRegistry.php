<?php declare(strict_types=1);

namespace App\Domain\Process\Task;

interface TaskRegistry
{
    /**
     * @return array|Task[]
     */
    public function getAll(): array;

    public function add(Task $task): void;

    public function getByStatus(Status $status): array;

    public function getByName(string $name): array;

    public function remove(Task $task): void;
}
