<?php

namespace App\Domain;

use App\Domain\Ports\Incoming\AddTask;
use App\Domain\Ports\Incoming\AssignTask;
use App\Domain\Ports\Incoming\ChangeStatus;
use App\Domain\Ports\Outgoing\TaskRepository;
use App\Domain\Ports\Outgoing\UserRepository;
use App\Domain\Task\Status;
use App\Domain\Task\Task;
use App\Domain\User\User;

class TaskService implements AddTask, AssignTask, ChangeStatus
{
    private $taskRepository;

    private $userRepository;

    /**
     * TaskService constructor.
     * @param $taskRepository
     * @param $userRepository
     */
    public function __construct(TaskRepository $taskRepository, UserRepository $userRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
    }

    public function addTask($newTask)
    {
        $status = new Status($newTask->status);
        $task = new Task($newTask->name, $status);
        $this->taskRepository->add($task);
    }

    public function assign(Task $task, User $user)
    {
        $task->assign($user);
    }

    public function change(Task $task, Status $status, User $user)
    {
        $task->changeStatusByUser($status, $user);
    }
}
