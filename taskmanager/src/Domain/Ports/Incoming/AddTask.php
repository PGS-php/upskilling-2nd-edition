<?php

namespace App\Domain\Ports\Incoming;

interface AddTask
{
    public function addTask($task);
}