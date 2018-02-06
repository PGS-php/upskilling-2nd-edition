<?php

namespace spec\App\Application\Task;

use App\Application\Task\Status;
use App\Application\Task\Task;
use App\Application\Task\UnexpectedStatusChangeException;
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

    function it_should_has_createdat_date()
    {
        $this->getCreatedAt()->shouldReturnAnInstanceOf(\DateTimeInterface::class);
    }

    function it_should_has_updatedat_date()
    {
        $this->getUpdatedAt()->shouldReturnAnInstanceOf(\DateTimeInterface::class);
    }

    function it_has_assignment()
    {
        $this->hasAssignment()->shouldReturn(false);
    }

    function it_should_has_priority()
    {
        $this->getPriority()->shouldReturn(Task::PRIORITY_MAJOR);
    }

    function it_should_be_possible_to_change_status(User $user)
    {
        $this->beConstructedWith(
            "Add switch language button",
            Status::toDo()
        );

        $status = Status::done();

        $this->setStatus($status, $user);
        $this->getStatus()->shouldReturn($status);
    }

    function it_should_have_assigned_user_after_change_status_to_in_progress(User $user)
    {
        $this->beConstructedWith(
            "Add switch language button",
            Status::toDo()
        );
        $this->setStatus(Status::inProgress(), $user);
        $this->assigned()->shouldReturn($user);
    }

    function it_should_not_have_assigned_user_after_change_status_to_todo(User $user)
    {
        $this->beConstructedWith(
            "Add switch language button",
            Status::inProgress()
        );
        $this->setStatus(Status::toDo(), $user);
        $this->hasAssignment()->shouldReturn(false);
    }

    function it_should_throw_exception_when_status_is_changed_from_close(User $user)
    {
        $this->beConstructedWith(
            "Add switch language button",
            Status::closed()
        );
        $this->shouldThrow(UnexpectedStatusChangeException::class)->duringSetStatus(Status::toDo(), $user);
    }
}
