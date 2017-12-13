<?php declare(strict_types=1);

namespace spec\App\Application\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserAlreadyExistExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Application\User\UserAlreadyExistException');
        $this->shouldBeAnInstanceOf(\LogicException::class);
    }
}
