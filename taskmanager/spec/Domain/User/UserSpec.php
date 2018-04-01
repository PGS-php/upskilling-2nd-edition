<?php

namespace spec\App\Domain\User;

use App\Domain\User\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\UuidInterface;

class UserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(User::class);
    }

    function let()
    {
        $this->beConstructedWith("Carl");
    }

    function it_should_has_guid()
    {
        $this->getId()->shouldReturnAnInstanceOf(UuidInterface::class);
    }

    function it_should_has_first_name()
    {
        $this->getFirstName()->shouldReturn("Carl");
    }
}
