<?php

namespace App\Domain\Ports\Outgoing;

interface MessageRepository
{
    public function add($message);

    public function has($message);
}
