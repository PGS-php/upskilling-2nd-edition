<?php declare(strict_types=1);

namespace spec\App\Domain\Process\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnassignedUserExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Domain\Process\User\UnassignedUserException');
        $this->shouldBeAnInstanceOf(\LogicException::class);
    }
}
