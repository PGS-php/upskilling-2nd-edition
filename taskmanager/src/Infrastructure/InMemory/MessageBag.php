<?php declare(strict_types=1);

namespace App\Infrastructure\InMemory;

use \App\Application\Message\MessageBag as BaseMessageBag;

class MessageBag implements BaseMessageBag
{
    /** @var string[] */
    private $messages = [];

    public function add(string $message): void
    {
        $this->messages[] = $message;
    }

    public function has(string $message): bool
    {
        return array_search($message, $this->messages) !== false;
    }
}
