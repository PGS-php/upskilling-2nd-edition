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
}
