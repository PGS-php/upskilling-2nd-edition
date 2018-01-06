<?php declare(strict_types=1);

namespace App\Application\Report;

class Criteria
{
    private const CRITERIA_TYPES = [
        'status',
        'assign',
        'updated after',
        'updated before',
    ];

    private $criteria = [];

    public function add(string $type, $criteria): void
    {
        if (!$this->isAllowedCriteria($type)) {
            throw new \InvalidArgumentException();
        }
        $this->criteria[$type][] = $criteria;
    }

    public function getCriteria(): array
    {
        return $this->criteria;
    }

    private function isAllowedCriteria($type): bool
    {
        return in_array($type, self::CRITERIA_TYPES);
    }
}
