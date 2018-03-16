<?php

use App\Domain\Process\Task\Status;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use App\Domain\Process\Task\Task;
use App\Domain\Process\User\User;
use App\Adapters\Outgoing\InMemory\TaskRepository;
use App\Adapters\Outgoing\InMemory\UserRepository;
use App\Adapters\Outgoing\InMemory\MessageRepository;
use App\Domain\Process\Task\UnexpectedStatusChangeException;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /** @var TaskRepository */
    private $taskRepository;

    /** @var UserRepository */
    private $userRepository;

    /** @var MessageRepository */
    private $messageRepository;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->taskRepository = new TaskRepository();
        $this->userRepository = new UserRepository();
        $this->messageRepository = new MessageRepository();
    }

    /**
     * @Transform :user
     */
    public function convertUserNameToUser(string $user): User
    {
        $userCollection = $this->userRepository->getByName($user);

        return reset($userCollection);
    }


    /**
     * @Transform :task
     */
    public function convertTaskNameToTask(string $task): Task
    {
        $taskCollection = $this->taskRepository->getByName($task);

        return reset($taskCollection);
    }

    /**
     * @Transform :status
     */
    public function convertStatusNameToStatus(string $status): Status
    {
        switch ($status) {
            case 'TODO':
                return Status::toDo();
            case 'IN PROGRESS':
                return Status::inProgress();
            case 'DONE':
                return Status::done();
            case 'CLOSED':
                return Status::closed();
        }

        throw new Exception(sprintf(
            'Unknow status name "%s". Allowed options: "TODO", "IN PROGRESS", "DONE", "CLOSED"',
            $status
        ));
    }

    /**
     * @Transform :exception
     */
    public function convertToUnexpectedStatusChangeException(string $exception): UnexpectedStatusChangeException
    {
        return UnexpectedStatusChangeException::createForClosedStatus();
    }

    /**
     * @Given there is no tasks
     */
    public function thereIsNoTasks()
    {
        $this->taskRepository = new TaskRepository();
    }

    /**
     * @Given there is no notifications
     */
    public function thereIsNoNotifications()
    {
        $this->messageRepository = new MessageRepository();
    }

    /**
     * @When I create a task named :arg1
     */
    public function iCreateATaskNamed($taskName)
    {
        $task = new Task($taskName, Status::toDo());
        $this->taskRepository->add($task);
    }

    /**
     * @Then there should be :arg1 tasks with :arg2 status
     */
    public function thereShouldBeTasksWithStatus($count, $status)
    {
        Assert::assertCount(
            (int)$count,
            $this->taskRepository->getByStatus(Status::toDo())
        );
    }

    /**
     * @Given there are follow users:
     */
    public function thereAreFollowUsers(TableNode $table)
    {
        foreach ($table as $item) {
            $user = new User($item['Name']);
            $this->userRepository->add($user);
        }
    }

    /**
     * @Given there is unassigned task named :name
     */
    public function thereIsUnassignedTaskNamed($name)
    {
        $task = new Task($name, Status::toDo());
        $this->taskRepository->add($task);
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
        $this->taskRepository->add($task);
    }

    /**
     * @Given there is a task named :taskName with :status status
     */
    public function thereIsTaskNamedWithStatus(string $taskName, Status $status)
    {
        $task = new Task($taskName, $status);

        $this->taskRepository->add($task);
    }

    /**
     * @Then there should be :count tasks
     */
    public function thereShouldBeTasks($count)
    {
        Assert::assertCount(
            (int)$count,
            $this->taskRepository->getAll()
        );
    }

    /**
     * @Then task should have create date
     */
    public function taskShouldHaveCreateDate()
    {
        $tasks = $this->taskRepository->getAll();
        $now = new \DateTime();
        Assert::assertEquals(
            $now->format(Task::DATE_FORMAT),
            reset($tasks)->getCreatedAt()->format(Task::DATE_FORMAT)
        );
    }

    /**
     * @Then task should have update date
     */
    public function taskShouldHaveUpdateDate()
    {
        $tasks = $this->taskRepository->getAll();
        $now = new \DateTime();
        Assert::assertEquals(
            $now->format(Task::DATE_FORMAT),
            reset($tasks)->getUpdatedAt()->format(Task::DATE_FORMAT)
        );
    }

    /**
     * @When I change task named :task priority to :priority
     */
    public function iChangeTaskNamedPriorityTo(Task $task, string $priority)
    {
        $task->setPriority($priority);
    }

    /**
     * @Then task named :task should have priority value equal to :priority
     */
    public function taskNamedShouldHavePriorityValueEqualTo(Task $task, string $priority)
    {
        Assert::assertEquals($priority, $task->getPriority());
    }

    /**
     * @When I remove task named :task
     */
    public function iRemoveTaskNamed(Task $task)
    {
        $this->taskRepository->remove($task);
    }

    /**
     * @Then task named :name should no longer exist
     */
    public function taskNamedShouldNoLongerExist(string $name)
    {
        Assert::assertEmpty($this->taskRepository->getByName($name));
    }

    /**
     * @When user named :user changes task named :task status to :status
     */
    public function userNamedChangesTaskNamedStatusTo(User $user, Task $task, Status $status)
    {
        $task->changeStatusByUser($status, $user);
    }

    /**
     * @Then task named :task (still) should have status :status
     */
    public function taskNamedShouldHaveStatus(Task $task, Status $status)
    {
        Assert::assertTrue(
            $task->getStatus()->equals($status)
        );
    }

    /**
     * @Then task named :task should be unassigned
     */
    public function taskNamedShouldBeUnassigned(Task $task)
    {
        Assert::assertNotTrue($task->hasAssignment());
    }

    /**
     * @When user named :user tries to change task named :task status to :status
     */
    public function userNamedTriesToChangeTaskNamedStatus(User $user, Task $task, Status $status)
    {
        try {
            $task->changeStatusByUser($status, $user);
        } catch (UnexpectedStatusChangeException $exception) {
            $this->messageRepository->add($exception->getMessage());
        }
    }

    /**
     * @Then user named :user should see notice that changing closed task status is disallowed
     */
    public function userNamedShouldSeeNoticeThatChangingClosedTaskStatusIsDisallowed(User $user)
    {
        $exception = UnexpectedStatusChangeException::createForClosedStatus();

        Assert::assertTrue(
            $this->messageRepository->has($exception->getMessage())
        );
    }
}
