<?php

namespace spec\App\Domain\Process\Task;

use App\Domain\Process\Task\Status;
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

    function it_should_has_todo_static_constructor()
    {
        $this->shouldReturnAnInstanceOf(Status::class);
    }

    function it_should_has_in_progress_static_contstructor()
    {
        $this->beConstructedThrough('inProgress');
        $this->shouldReturnAnInstanceOf(Status::class);
    }

    function it_should_has_done_static_contstructor()
    {
        $this->beConstructedThrough('done');
        $this->shouldReturnAnInstanceOf(Status::class);
    }

    function it_should_has_closed_static_contstructor()
    {
        $this->beConstructedThrough('closed');
        $this->shouldReturnAnInstanceOf(Status::class);
    }
}
