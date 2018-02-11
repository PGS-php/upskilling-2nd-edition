<?php

namespace App\Infrastructure\Doctrine\Repository;

use App\Application\Task\Task;
use Doctrine\ORM\EntityRepository;


class TaskDoctrineRepository extends EntityRepository
{
    /**
     * @param Task $task
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add(Task $task)
    {
        $this->getEntityManager()->persist($task);
        $this->getEntityManager()->flush();
    }
}
