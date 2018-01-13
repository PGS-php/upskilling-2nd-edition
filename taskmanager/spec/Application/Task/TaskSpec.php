<?php

namespace spec\App\Application\Task;

use App\Application\Task\Status;
use App\Application\Task\Task;
use App\Application\User\UnassignedUserException;
use App\Application\User\User;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\UuidInterface;

class TaskSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Task::class);
    }

    function let()
    {
        $this->beConstructedWith(
            "Add switch language button",
            Status::toDo()
        );
    }

    function it_should_has_guid()
    {
        $this->getId()->shouldReturnAnInstanceOf(UuidInterface::class);
    }

    function it_should_has_status()
    {
        $this->getStatus()->shouldReturnAnInstanceOf(Status::class);
    }

    function it_should_not_has_assigned_user()
    {
        $this->shouldThrow(UnassignedUserException::class)->duringAssigned();
    }

    function it_should_has_assigned_user(User $user)
    {
        $this->assign($user);
        $this->assigned()->shouldReturn($user);
    }

    function it_has_assignment()
    {
        $this->hasAssignment()->shouldReturn(false);
    }

    function it_should_has_priority()
    {
        $this->getPriority()->shouldReturn(Task::PRIORITY_MAJOR);
    }
}
