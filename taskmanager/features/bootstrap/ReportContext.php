<?php declare(strict_types=1);

use App\Application\Task\Status;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use App\Application\Report\Criteria;

/**
 * Defines application features from the specific context.
 */
class ReportContext implements Context
{
    /** @var \App\Application\Task\TaskRegistry */
    private $taskRegistry;

    /** @var \App\Application\Report\ReportRegistry */
    private $reportRegistry;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given There is no report(s)
     */
    public function thereIsNoReports()
    {
        $this->reportRegistry = new \App\Infrastructure\InMemory\ReportRegistry();
    }

    /**
     * @Given there are :arg1 tasks with :arg2 status
     */
    public function thereAreTasksWithStatus($amount, $status)
    {
        $this->taskRegistry = new \App\Infrastructure\InMemory\TaskRegistry();
        $status = Status::toDo();
        for ($i = 0; $i < $amount; $i++) {
            $task = new \App\Application\Task\Task('name', $status);
            $this->taskRegistry->add($task);
        }
    }

    /**
     * @When I generate report with criteria :arg1
     */
    public function iGenerateReportWithCriteria($criteria)
    {
        /** @var Criteria $criteria */
        $criteria = Criteria::{$criteria}();
        $report = new \App\Application\Report\Report($criteria->__toString());

        switch ($criteria->getCriteria()) {
            case Criteria::UNFINISHED:
                /** @var \App\Application\Task\Task $task */
                $count = 0;
                foreach ($this->taskRegistry->getByStatus(Status::toDo()) as $task) {
                    $count++;
                }
                $report->addElement('Unfinished tasks: '.$count);
                break;
            default:
        }

        $this->reportRegistry->add($report);
    }

    /**
     * @Then there should be :arg1 report(s)
     */
    public function thereShouldBeReport($amount)
    {
        Assert::assertEquals($amount, count($this->reportRegistry->getAll()));
    }
}
