<?php declare(strict_types=1);

namespace App\Application\Task;

class Status
{
    private const TODO = 'TODO';

    private $status;

    private function __construct(string $status)
    {
        $this->status = $status;
    }

    public function __toString()
    {
        return (string) $this->status;
    }

    public function equals(Status $status): bool
    {
        return (string) $status === (string) $this;
    }

    public static function toDo(): self
    {
        return new self(self::TODO);
    }
}
