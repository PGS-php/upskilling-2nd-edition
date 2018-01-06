<?php

use App\Application\Task\Status;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use App\Application\Task\Task;
use App\Application\User\User;
use App\Infrastructure\InMemory\TaskRegistry;
use App\Infrastructure\InMemory\UserRegistry;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /** @var TaskRegistry */
    private $taskRegistry;

    /** @var UserRegistry */
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
        $this->taskRegistry = new TaskRegistry();
    }

    /**
     * @Given there is no tasks
     */
    public function thereIsNoTasks()
    {
        $this->taskRegistry = new TaskRegistry();
    }

    /**
     * @When I create a task named :arg1
     */
    public function iCreateATaskNamed($taskName)
    {
        $task = new Task($taskName, Status::toDo());
        $this->taskRegistry->add($task);
    }

    /**
     * @Then there should be :arg1 tasks with :arg2 status
     */
    public function thereShouldBeTasksWithStatus($count, $status)
    {
        Assert::assertCount(
            (int)$count,
            $this->taskRegistry->getByStatus(Status::toDo())
        );
    }

    /**
     * @Given there are follow users:
     */
    public function thereAreFollowUsers(TableNode $table)
    {
        $this->userRegistry = new UserRegistry();
        foreach ($table as $item) {
            $user = new User($item['Name']);
            $this->userRegistry->add($user);
        }
    }

    /**
     * @Given there is unassigned task named :name
     */
    public function thereIsUnassignedTaskNamed($name)
    {
        $task = new Task($name, Status::toDo());
        $this->taskRegistry->add($task);
    }

    /**
     * @When I assigned task named :task to user named :user
     */
    public function iAssignedTaskNamedToUserNamed(Task $task, User $user)
    {
        $task->assign($user);
    }

    /**
     * @Then task named :task should be assigned to user named :user
     */
    public function taskNamedShouldBeAssignedToUserNamed(Task $task, User $user)
    {
        Assert::assertTrue($task->hasAssignment());
        Assert::assertEquals(
            $user,
            $task->assigned()
        );
    }

    /**
     * @Given there is task named :name assigned to user named :user
     */
    public function thereIsTaskNamedAssignedToUserNamed($name, User $user)
    {
        $task = new Task($name, Status::toDo());
        $task->assign($user);
        $this->taskRegistry->add($task);
    }

    /**
     * @Transform :task
     */
    public function convertTaskNameToTask(string $task): Task
    {
        $taskCollection = $this->taskRegistry->getByName($task);

        return reset($taskCollection);
    }

    /**
     * @Transform :user
     */
    public function convertUserNameToUser(string $user): User
    {
        $userCollection = $this->userRegistry->getByName($user);

        return reset($userCollection);
    }

    /**
     * @When I create a task named :name with create date :date
     */
    public function iCreateATaskNamedWithCreateDate($name, $date)
    {
        $task = new Task($name, Status::toDo(), DateTime::createFromFormat('Y-m-d H:i:s', $date));
        $this->taskRegistry->add($task);
    }

    /**
     * @Then there should be :count tasks
     */
    public function thereShouldBeTasks($count)
    {
        Assert::assertCount(
            (int)$count,
            $this->taskRegistry->getAll()
        );
    }

    /**
     * @Then create date should be :date
     */
    public function createDateShouldBe($date)
    {
        $tasks = $this->taskRegistry->getAll();
        Assert::assertEquals(
            DateTime::createFromFormat('Y-m-d H:i:s', $date),
            reset($tasks)->getCreate()
        );
    }

    /**
     * @When I create a task named :name with create date :create and update date :update
     */
    public function iCreateATaskNamedWithCreateDateAndUpdateDate($name, $create, $update)
    {
        $task = new Task(
            $name, Status::toDo(),
            DateTime::createFromFormat('Y-m-d H:i:s', $create),
            DateTime::createFromFormat('Y-m-d H:i:s', $update)
        );
        $this->taskRegistry->add($task);
    }

    /**
     * @Then update date should be :date
     */
    public function updateDateShouldBe($date)
    {
        $tasks = $this->taskRegistry->getAll();
        Assert::assertEquals(
            DateTime::createFromFormat('Y-m-d H:i:s', $date),
            reset($tasks)->getUpdate()
        );
    }
}
