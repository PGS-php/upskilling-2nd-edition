<?php declare(strict_types=1);

namespace App\Application\Report;

use App\Application\Task\Task;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Report
{
    protected $id;
    protected $name;
    protected $elements;

    public function __construct(string $name)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->elements = [];
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addElement(string $element)
    {
        $this->elements[] = $element;
    }

    public function getElements(): array
    {
        return $this->elements;
    }
}
