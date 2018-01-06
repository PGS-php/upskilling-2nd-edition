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

    public function generate(TaskRegistry $tasks)
    {
        //@TODO: foreach criteria get tasks and add to elements or tasks
        // how to decide if assigne tasks or elements like Efficiency | 33,3% hmm.. ?
    }

    private function addElement(string $element)
    {
        $this->elements[] = $element;
    }

    public function getElements(): array
    {
        return $this->elements;
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
