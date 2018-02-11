<?php declare(strict_types=1);

namespace App\Application\Message;

interface MessageBag
{
    public function add(string $message): void;

    public function has(string $message): bool;
}
