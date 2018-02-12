<?php declare(strict_types=1);

namespace spec\App\Application\DomainManager;

use App\Application\DomainManager\TaskStatusManager;
use App\Application\Task\Status;
use App\Application\Task\Task;
use App\Application\User\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TaskStatusManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TaskStatusManager::class);
    }

    function it_shoul_have_possibility_to_change_task_status(Task $task, Status $status, User $user)
    {
        $status->equals(Argument::any())->willReturn(false);

        $this->changeTaskStatusByUser($task, $status, $user);
    }
}
