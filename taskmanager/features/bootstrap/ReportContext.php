<?php declare(strict_types=1);

use App\Application\Task\Status;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use App\Application\Report\Criteria;
use App\Infrastructure\InMemory\TaskRegistry;
use App\Application\Task\Task;
use App\Application\User\User;
use App\Application\Report\Report;

/**
 * Defines application features from the specific context.
 */
class ReportContext implements Context
{
    /** @var \App\Application\Task\TaskRegistry */
    private $taskRegistry;

    /** @var \App\Application\Report\ReportRegistry */
    private $reportRegistry;

    private $report;

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
     * @Then there should be :arg1 report(s)
     */
    public function thereShouldBeReport($amount)
    {
        Assert::assertEquals($amount, count($this->reportRegistry->getAll()));
    }

    /**
     * @Given the following tasks exist:
     */
    public function theFollowingTasksExist(TableNode $table)
    {
        $this->taskRegistry = new TaskRegistry();
        foreach ($table as $item) {
            //@TODO: implement other statuses
            $status = Status::toDo();
            //@TODO: implement create and update date
            // after implement create/update
//            $task = new Task($item['Name'], $status, $item['Create date'], $item['Update date']);
            $task = new Task($item['Name'], $status);
            if (!empty($item['Assign'])) {
                $user = new User($item['Assign']);
                $task->assign($user);
            }
            $this->taskRegistry->add($task);
        }
    }

    /**
     * @When I generate a report with the following criteria:
     */
    public function iGenerateAReportWithTheFollowingCriteria(TableNode $table)
    {
        $criteria = new Criteria();
        foreach ($table as $item) {
            $criteria->add($item['Key'], $item['Value']);
        }

        $this->report = new Report('name', $criteria);
        $this->report->generate($this->taskRegistry);
    }

    /**
     * @Then report should contain elements:
     */
    public function reportShouldContainElements(TableNode $table)
    {
        throw new PendingException();
        //@TODO: simply check $this->>report->getElements
    }

    /**
     * @Then report should contain tasks:
     */
    public function reportShouldContainTasks(TableNode $table)
    {
        throw new PendingException();
        //@TODO: simply check $this->>report->getTasks
    }
}
