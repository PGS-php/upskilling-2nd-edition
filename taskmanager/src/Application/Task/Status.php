<?php declare(strict_types=1);

namespace App\Application\Task;

class Status
{
    private const TODO = 'TODO';
    private const DONE = 'DONE';
    private const CLOSED = 'CLOSED';

    private $status;

    private function __construct(string $status)
    {
        $this->status = $status;
    }

    public function __toString()
    {
        return (string)$this->status;
    }

    public function equals(Status $status): bool
    {
        return strtolower((string)$status) === strtolower((string)$this);
    }

    public static function toDo(): self
    {
        return new self(self::TODO);
    }

    public static function done(): self
    {
        return new self(self::DONE);
    }

    public static function closed(): self
    {
        return new self(self::CLOSED);
    }
}
