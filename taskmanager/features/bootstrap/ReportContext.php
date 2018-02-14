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

    /** @var Report */
    private $report;

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
            switch ($item['Status']) {
                case 'TODO':
                    $status = Status::toDo();
                    break;
                case 'DONE':
                    $status = Status::done();
                    break;
                case 'CLOSED':
                    $status = Status::closed();
                    break;
                default:
                    $status = Status::toDo();
            }

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
     * @Then report should contain tasks:
     */
    public function reportShouldContainTasks(TableNode $table)
    {
        $tasks = $this->report->getTasks();
        foreach ($table as $item) {
            $containTask = false;
            foreach ($tasks as $task) {
                /** @var Task $task */
                if ($task->getName() === $item['Name']) {
                    $containTask = true;
                }
            }
            Assert::assertTrue($containTask);
        }
    }
}
