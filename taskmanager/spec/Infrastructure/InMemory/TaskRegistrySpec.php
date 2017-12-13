<?php

namespace spec\App\Infrastructure\InMemory;

use App\Application\Task\TaskRegistry;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TaskRegistrySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldImplement(TaskRegistry::class);
    }

    function it_should_have_possibility_to_find_by_name()
    {
        $this->getByName('Add button')->shouldBeArray();
    }
}
