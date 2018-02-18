<?php declare(strict_types=1);

namespace spec\App\Infrastructure\InMemory;

use App\Application\Message\MessageBag;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MessageBagSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldImplement(MessageBag::class);
    }

    function it_should_have_possibility_to_add_message()
    {
        $this->add('message');
    }

    function it_should_have_possibility_to_check_if_message_exists()
    {
        $this->has('message')->shouldBeBool();
    }
}
