<?php declare(strict_types=1);

namespace App\Infrastructure\Adapters\Outgoing\InMemory;

class MessageRepository implements \App\Domain\Ports\Outgoing\MessageRepository
{
    private $messages = [];


    public function add($message)
    {
        $this->messages[] = $message;
    }

    public function has($message)
    {
        return in_array($message, $this->messages);
    }
}
