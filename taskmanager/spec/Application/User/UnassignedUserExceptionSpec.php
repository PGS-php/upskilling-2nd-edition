<?php declare(strict_types=1);

namespace spec\App\Application\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnassignedUserExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Application\User\UnassignedUserException');
        $this->shouldBeAnInstanceOf(\LogicException::class);
    }
}
