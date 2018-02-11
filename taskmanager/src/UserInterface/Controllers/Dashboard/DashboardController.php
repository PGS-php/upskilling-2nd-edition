<?php

namespace App\UserInterface\Controllers\Dashboard;

use App\Infrastructure\Doctrine\Repository\TaskDoctrineRepository;
use Silex\Application;

class DashboardController
{
    /**
     * @var Application
     */
    private $application;

    /**
     * DashboardController constructor.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Show all task in list
     * @return mixed
     */
    public function indexAction()
    {
        /** @var TaskDoctrineRepository $taskRepository */
        $taskRepository = $this->application['task_repository'];
        $tasks = $taskRepository->findAll();

        return $this->application['twig']->render('home.html.twig', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Create new task
     */
    public function createAction()
    {
        // TODO Implementation to add new task
    }
}
