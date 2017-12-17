<?php declare(strict_types=1);

namespace App\Application\Report;

class Criteria
{
    public const UNFINISHED = 'UNFINISHED';
    public const DONE = 'DONE';
    public const INPROGRESS = 'INPROGRESS';
    public const EFFICIENCY = 'EFFICIENCY';

    private $criteria;

    private function __construct(string $criteria)
    {
        $this->criteria = $criteria;
    }


    public function __toString()
    {
        return (string)$this->criteria;
    }

    public function equals(Criteria $criteria): bool
    {
        return (string)$criteria === (string)$this;
    }

    public static function unfinished(): self
    {
        return new self(self::UNFINISHED);
    }

    public static function done(): self
    {
        return new self(self::DONE);
    }

    public static function efficiency()
    {
        return new self(self::EFFICIENCY);
    }

    public static function inprogress()
    {
        return new self(self::INPROGRESS);
    }

    public function getCriteria(): string
    {
        return $this->criteria;
    }
}
