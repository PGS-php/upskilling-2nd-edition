<?php

namespace App\Presentation\Controller;

use App\Application\Command\CreateTaskCommand;
use App\Application\Query\AllTasksQuery;
use App\Application\ServiceBus\CommandBus;
use App\Application\ServiceBus\QueryBus;
use App\Infrastructure\Adapters\Incoming\JSON\AddTask;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends Controller
{
    /**
     * @Route("/")
     */
    public function listAction()
    {
        $query = new AllTasksQuery();
        /** @var QueryBus $queryBus */
        $queryBus = $this->container->get('application.query_bus');
        $tasks = $queryBus->handle($query);

        return JsonResponse::create($tasks);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/new")
     */
    public function createAction(Request $request)
    {
        $data = $request->getContent();

        // TODO Need validation data

        $command = new CreateTaskCommand($data);
        /** @var CommandBus $commandBus */
        $commandBus = $this->container->get('application.command_bus');
        $commandBus->handle($command);
        
        return JsonResponse::create(['message' => 'Task created!']);
    }
}