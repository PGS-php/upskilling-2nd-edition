<?php declare(strict_types=1);

namespace App\Infrastructure\InMemory;

use App\Application\Report\Report;
use App\Application\Report\ReportRegistry as BaseReportRegistry;

class ReportRegistry implements BaseReportRegistry
{
    private $reports = [];

    /**
     * @inheritdoc
     */
    public function getAll(): array
    {
        return $this->reports;
    }

    public function add(Report $report): void
    {
        $this->reports[(string)$report->getId()] = $report;
    }

    public function getByName(string $name): array
    {
        return array_filter($this->reports, function (Report $report) use ($name) {
            return $name->equals($report->getName());
        });
    }

}
