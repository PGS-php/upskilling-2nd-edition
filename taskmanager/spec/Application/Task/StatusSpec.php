<?php

namespace spec\App\Application\Task;

use App\Application\Task\Status;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StatusSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('toDo');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Status::class);
    }

    function it_should_be_comparable()
    {
        $status = Status::toDo();

        $this->equals($status)->shouldReturn(true);
    }

    function it_should_be_string_castable()
    {
        $this->__toString()->shouldReturn('TODO');
    }

    function it_should_has_todo_static_contstructor()
    {
        $this->shouldReturnAnInstanceOf(Status::class);
    }
}
