<?php

namespace App\Domain\Ports\Outgoing;

use App\Domain\Task\Status;
use App\Domain\Task\Task;
use App\Domain\User\User;

interface TaskRepository
{
    public function getAll();

    public function getByStatus(Status $status);

    public function getByName(string $name);

    public function add(Task $task);

    public function changeAssignee(Task $task, User $user);

    public function changeStatus(Task $task, Status $status);

    public function remove(Task $task);
}