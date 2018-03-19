<?php

namespace App\Controller;

use App\Adapters\Incoming\JSON\AddTask;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends Controller
{
    /**
     * @Route("/")
     */
    public function listAction()
    {
        return $this->render('task/list.html.twig', array(
            'tasks' => []
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/new")
     */
    public function createAction(Request $request)
    {
        /** @var AddTask $addTask */
        $addTask = $this->get('add_task');
        $data = $request->getContent();
        $addTask->addTask($data);


        return $this->render('task/list.html.twig', array(
            'tasks' => []
        ));
    }
}