<?php declare(strict_types=1);

namespace App\Application\Report;

interface ReportRegistry
{
    /**
     * @return array|Report[]
     */
    public function getAll(): array;

    public function add(Report $report): void;

    public function getByName(string $name): array;
}
