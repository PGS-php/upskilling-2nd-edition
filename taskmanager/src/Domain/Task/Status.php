<?php declare(strict_types=1);

namespace App\Domain\Task;

class Status
{
    private const TODO = 'TODO';
    private const IN_PROGRESS = 'IN PROGRESS';
    private const DONE = 'DONE';
    private const CLOSED = 'CLOSED';

    private $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function __toString()
    {
        return (string)$this->status;
    }

    public function equals(Status $status): bool
    {
        return (string)$status === (string)$this;
    }

    public static function toDo(): self
    {
        return new self(self::TODO);
    }

    public static function inProgress(): self
    {
        return new self(self::IN_PROGRESS);
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
