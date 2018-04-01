<?php declare(strict_types=1);

namespace spec\App\Domain\Task;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnexpectedStatusChangeExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Domain\Task\UnexpectedStatusChangeException');
        $this->shouldBeAnInstanceOf(\LogicException::class);
    }

    function it_should_have_factory_method_for_closed_status()
    {
        $this::beConstructedThrough('createForClosedStatus');
        $this->shouldHaveType('App\Domain\Task\UnexpectedStatusChangeException');
        $this->shouldBeAnInstanceOf(\LogicException::class);
    }
}
