<?php declare(strict_types=1);

namespace App\Application\DomainManager;

use App\Application\Task\Status;
use App\Application\Task\Task;
use App\Application\User\User;

class TaskStatusManager
{
    public function changeTaskStatusByUser(Task $task, Status $status, User $user): void
    {
        $task->setStatus($status);

        if ($status->equals(Status::inProgress())) {
            $task->assign($user);
        } elseif ($status->equals(Status::toDo())) {
            $task->unassign();
        }
    }
}
