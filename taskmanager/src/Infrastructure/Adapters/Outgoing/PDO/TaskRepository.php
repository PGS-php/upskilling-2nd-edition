<?php

namespace App\Infrastructure\Adapters\Outgoing\PDO;

use App\Domain\Task\Status;
use App\Domain\Task\Task;
use App\Domain\User\User;

class TaskRepository implements \App\Domain\Ports\Outgoing\TaskRepository
{
    private $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $sth = $this->db->prepare('SELECT * FROM task');
        $sth->execute();
        $results = $sth->fetchAll();

        foreach ($results as $item) {
            $tasks[] = [
                'id' => (string) $item['id'],
                'name' => (string) $item['name'],
                'description' => (string) $item['description'],
                'priority' => (string)$item['priority']
            ];
        }

        return empty($tasks) ? [] : $tasks;
    }

    public function getByStatus(Status $status)
    {
        // TODO: Implement getByStatus() method.
    }

    public function getByName(string $name)
    {
        // TODO: Implement getByName() method.
    }

    public function add(Task $task)
    {
        $sth = $this->db->prepare("INSERT INTO tm.task (id, name, status, priority) VALUES (:id, :name, :status, :priority)");
        $sth->bindParam(':id', $task->getId()->toString());
        $sth->bindParam(':name', $task->getName());
        $sth->bindParam(':status', $task->getStatus()->__toString());
        $sth->bindParam(':priority', $task->getPriority());
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

    public function remove(Task $task)
    {
        // TODO: Implement remove() method.
    }
}