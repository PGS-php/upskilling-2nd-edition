<?php

use PHPUnit\Framework\TestCase;
use App\Application\Task\Task;
use App\Application\Task\Status;
use App\Application\User\User;

class ExampleTest extends TestCase
{
    public function testExample()
    {
        $user = new User('Tom');
        $task = new Task('task name', Status::toDo());

        $task->assign($user);

        $this->assertEquals($user, $task->assigned());
    }
}
