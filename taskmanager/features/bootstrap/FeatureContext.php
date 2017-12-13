<?php

use App\Application\Task\Status;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /** @var \App\Application\Task\TaskRegistry */
    private $taskRegistry;

    /** @var \App\Infrastructure\InMemory\UserRegistry */
    private $userRegistry;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->taskRegistry = new \App\Infrastructure\InMemory\TaskRegistry();
    }

    /**
     * @Given there is no tasks
     */
    public function thereIsNoTasks()
    {
        $this->taskRegistry = new \App\Infrastructure\InMemory\TaskRegistry();
    }

    /**
     * @When I create a task named :arg1
     */
    public function iCreateATaskNamed($taskName)
    {
        $task = new \App\Application\Task\Task($taskName, Status::toDo());
        $this->taskRegistry->add($task);
    }

    /**
     * @Then there should be :arg1 tasks with :arg2 status
     */
    public function thereShouldBeTasksWithStatus($count, $status)
    {
        Assert::assertCount(
            (int) $count,
            $this->taskRegistry->getByStatus(Status::toDo())
        );
    }

    /**
     * @Given there are follow users:
     */
    public function thereAreFollowUsers(TableNode $table)
    {
        $this->userRegistry = new \App\Infrastructure\InMemory\UserRegistry();
        foreach ($table as $item) {
            $user = new \App\Application\User\User($item['Name']);
            $this->userRegistry->add($user);
        }
    }

    /**
     * @Given there is unassigned task named :arg1
     */
    public function thereIsUnassignedTaskNamed($name)
    {
        $task = new \App\Application\Task\Task($name, Status::toDo());
        $this->taskRegistry->add($task);
    }

    /**
     * @When I assigned task named :task to user named :arg2
     */
    public function iAssignedTaskNamedToUserNamed(\App\Application\Task\Task $task, $userName)
    {
        $userCollection = $this->userRegistry->getByName($userName);
        $user = reset($userCollection);
        $task->assign($user);
    }

    /**
     * @Then task named :task should be assigned to user named :userName
     */
    public function taskNamedShouldBeAssignedToUserNamed(\App\Application\Task\Task $task, $userName)
    {
        $userCollection = $this->userRegistry->getByName($userName);
        $user = reset($userCollection);

        Assert::assertTrue($task->hasAssignment());
        Assert::assertEquals(
            $user,
            $task->assigned()
        );
    }

    /**
     * @Transform :task
     */
    public function convertTaskNameToTask(string $task): \App\Application\Task\Task
    {
        $taskCollection = $this->taskRegistry->getByName($task);
        /** @var \App\Application\Task\Task $task */
        return reset($taskCollection);
    }

    /**
     * @Given there is task named :arg1 assigned to user named :arg2
     */
    public function thereIsTaskNamedAssignedToUserNamed($arg1, $arg2)
    {
        throw new PendingException();
    }
}
