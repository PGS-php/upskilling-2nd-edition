<?php

namespace spec\App\Infrastructure\InMemory;

use App\Application\Task\Task;
use App\Application\Task\TaskRegistry;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

class TaskRegistrySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldImplement(TaskRegistry::class);
    }

    function it_should_have_possibility_get_all_task()
    {
        $this->getAll()->shouldBeArray();
    }

    function it_should_have_possibility_add_task(Task $task, Uuid $uuid)
    {
        $uuid->__toString()->willReturn('3912201f-e9a9-4e49-b22d-8dc140b7a9a9');
        $task->getId()->willReturn($uuid);

        $this->add($task);

        $this->getAll()->shouldBeArray();
        $this->getAll()->shouldHaveCount(1);
    }

    function it_should_have_possibility_to_find_by_name()
    {
        $this->getByName('Add button')->shouldBeArray();
    }

    function it_should_have_possibility_remove_task(Task $task, Uuid $uuid)
    {
        $uuid->__toString()->willReturn('3912201f-e9a9-4e49-b22d-8dc140b7a9a9');
        $task->getId()->willReturn($uuid);

        $this->add($task);

        $this->getAll()->shouldBeArray();
        $this->getAll()->shouldHaveCount(1);

        $this->remove($task);

        $this->getAll()->shouldBeArray();
        $this->getAll()->shouldHaveCount(0);
    }
}
