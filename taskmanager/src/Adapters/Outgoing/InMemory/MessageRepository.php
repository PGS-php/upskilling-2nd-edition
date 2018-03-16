<?php declare(strict_types=1);

namespace App\Adapters\Outgoing\InMemory;

use App\Domain\Process\Task\Status;
use App\Domain\Process\Task\Task;
use App\Domain\Process\User\User;

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
