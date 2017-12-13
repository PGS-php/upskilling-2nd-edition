<?php

namespace spec\App\Application\Task;

use App\Application\Task\Status;
use App\Application\Task\Task;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
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
}
