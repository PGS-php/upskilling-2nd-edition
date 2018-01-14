<?php declare(strict_types=1);

namespace App\Application\Report;

use App\Application\Task\Task;
use App\Application\Task\TaskRegistry;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Report
{
    private $id;
    private $name;
    private $criteria;
    private $elements;
    private $tasks;

    public function __construct(string $name, Criteria $criteria)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->criteria = $criteria;
        $this->elements = [];
        $this->tasks = [];
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function generate(TaskRegistry $taskRegistry): void
    {
        $criterias = $this->criteria->getCriteria();

        foreach ($taskRegistry->getAll() as $task) {
            $matchCriteria = false;
            foreach ($criterias as $criteriaType => $criteriaValue) {
                if (!$this->meetCriteria($criteriaType, $criteriaValue, $task)) {
                    continue;
                }
                $matchCriteria = true;
            }

            if ($matchCriteria) {
                $this->addTask($task);
            }
        }
    }

    private function meetCriteria(string $criteriaType, string $criteriaValue, Task $task): bool
    {
        switch ($criteriaType) {
            case 'status':
                $statuses = explode(',', $criteriaValue);
                foreach ($statuses as $status) {
                    if ((string)$task->getStatus() === strtoupper($status)) {
                        return true;
                    }
                }
                break;

            case 'updated after':
                //@TODO: implement
                break;

            case 'updated before':
                //@TODO: implement
                break;
            case 'assign':
                //@TODO: implement
                break;
        }

        return false;
    }

    private function addTask(Task $task): void
    {
        $this->tasks[] = $task;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }
}
