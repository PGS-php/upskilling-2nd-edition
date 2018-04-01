<?php

namespace App\Application\ServiceBus;

class CommandBus
{
    private $commandHandlers = [];

    public function handle($command)
    {
        $className = (new \ReflectionClass($command))->getShortName();
        $className = sprintf('%sHandler', $className);
        $commandHandler = $this->commandHandlers[$className];
        return $commandHandler->handle($command);
    }

    public function register($commandHandler)
    {
        $className = (new \ReflectionClass($commandHandler))->getShortName();
        $this->commandHandlers[$className] = $commandHandler;
    }
}