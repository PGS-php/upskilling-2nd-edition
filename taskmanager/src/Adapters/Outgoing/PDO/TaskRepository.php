<?php

namespace App\Adapters\Outgoing\PDO;

use App\Domain\Process\Task\Status;
use App\Domain\Process\Task\Task;
use App\Domain\Process\User\User;

class TaskRepository implements \App\Domain\Ports\Outgoing\TaskRepository
{
    private $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function saveTask(Task $task)
    {
        $sth = $this->db->prepare('INSERT INTO task (name, status) VALUES (:name, :status)');
        $sth->bindParam(':name', $task->getName());
        $sth->bindParam(':status', $task->getStatus());
        $sth->execute();
    }

    public function changeAssignee(Task $task, User $user)
    {
        // TODO: Implement changeAssignee() method.
    }

    public function changeStatus(Task $task, Status $status)
    {
        // TODO: Implement changeStatus() method.
    }
}