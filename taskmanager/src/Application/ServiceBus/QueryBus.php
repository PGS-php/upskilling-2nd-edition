<?php

namespace App\Application\ServiceBus;

class QueryBus
{
    private $queryHandlers = [];

    public function handle($query)
    {
        $className = (new \ReflectionClass($query))->getShortName();
        $className = sprintf('%sHandler', $className);
        $queryHandler = $this->queryHandlers[$className];
        return $queryHandler->handle($query);
    }

    public function register($queryHandler)
    {
        $className = (new \ReflectionClass($queryHandler))->getShortName();
        $this->queryHandlers[$className] = $queryHandler;
    }
}