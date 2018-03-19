<?php

namespace spec\App\Domain\Ports\DTO;

use App\Domain\Ports\DTO\NewTask;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NewTaskSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(NewTask::class);
    }
}
