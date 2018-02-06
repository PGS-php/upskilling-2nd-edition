<?php declare(strict_types=1);

namespace spec\App\Application\Task;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Exception\LogicException;

class UnexpectedStatusChangeExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Application\Task\UnexpectedStatusChangeException');
        $this->shouldBeAnInstanceOf(\LogicException::class);
    }

    function it_should_have_factory_method_for_closed_status()
    {
        $this::beConstructedThrough('createForClosedStatus');
        $this->shouldHaveType('App\Application\Task\UnexpectedStatusChangeException');
        $this->shouldBeAnInstanceOf(\LogicException::class);
    }
}
