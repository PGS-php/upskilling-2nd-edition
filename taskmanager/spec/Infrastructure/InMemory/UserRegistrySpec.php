<?php

namespace spec\App\Infrastructure\InMemory;

use App\Application\User\User;
use App\Infrastructure\InMemory\UserRegistry;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

class UserRegistrySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldImplement(UserRegistry::class);
    }

    function it_should_have_possibility_get_all_users()
    {
        $this->getAll()->shouldBeArray();
    }

    function it_should_have_possibility_add_user(User $user, Uuid $uuid)
    {
        $uuid->__toString()->willReturn('3912201f-e9a9-4e49-b22d-8dc140b7a9a9');
        $user->getId()->willReturn($uuid);

        $this->add($user);

        $this->getAll()->shouldBeArray();
        $this->getAll()->shouldHaveCount(1);
    }

    function it_should_have_possibility_to_find_by_name()
    {
        $this->getByName('Sarah')->shouldBeArray();
    }
}
