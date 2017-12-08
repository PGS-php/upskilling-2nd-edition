<?php declare(strict_types=1);

namespace App\Application\Task;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Task
{
    protected $name;
    protected $id;
    protected $status;

    public function __construct(string $name, Status $status)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->status = $status;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }
}
