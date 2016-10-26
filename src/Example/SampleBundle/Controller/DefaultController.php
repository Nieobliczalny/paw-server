<?php

namespace Example\SampleBundle\Controller;

use Example\SampleBundle\Entity\User;
use Example\SampleBundle\Entity\Board;
use Example\SampleBundle\Entity\CardList;
use Example\SampleBundle\Entity\Card;
use Example\SampleBundle\Entity\Task;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends FOSRestController 
{
    public function getExampleAction()
    {
        $data = [
			'value1' => 'Test',
			'value2' => '300',
		];
		$view = $this->view($data,200);
		return $this->handleView($view);
    }
    public function putBoardsAction($name)
    {
        $board = new Board();
        $board->setName($name);

        $em = $this->getDoctrine()->getManager();
        $em->persist($board);
        $em->flush();

        $view = $this->view($board,200);
        return $this->handleView($view);
    }

    public function getBoardsAction()
    {
        $board = new Board();
        $board->setName('Adam');

        $em = $this->getDoctrine()->getManager();
        $em->persist($board);
        $em->flush();

        $view = $this->view($board,200);
        return $this->handleView($view);
    }
    public function getBoardAction($id)
    {
        $board = $this->getDoctrine()->getRepository('ExampleSampleBundle:Board')->find($id);

        $view = $this->view($board,200);
		return $this->handleView($view);
    }
    public function getBoardListsAction($id)
    {
		//TODO: $id określa tablicę z której listę pobrać
        $data = [[
			'id' => 1,
			'name' => 'List 1',
		],[
			'id' => 2,
			'name' => 'List 2',
		]];
		$view = $this->view($data,200);
		return $this->handleView($view);
    }
    public function getListsAction($list)
    {
		if ($list == 1) $data = [ 'id' => 1, 'name' => 'List 1' ];
		else if ($list == 2) $data = [ 'id' => 2, 'name' => 'List 2' ];
		else $data = [];
		$view = $this->view($data,200);
		return $this->handleView($view);
    }
    public function getListsTasksAction($list)
    {
		if ($list == 1) $data = [['name' => 'Task 1'], ['name' => 'Task 2']];
		else if ($list == 2) $data = [['name' => 'Task 1'], ['name' => 'Task 2'], ['name' => 'Task 3'], ['name' => 'Task 4']];
		else $data = [];
		$view = $this->view($data,200);
		return $this->handleView($view);
    }
    public function getLoggeduserAction()
    {
		$session = new Session();
		//$session->start();
		$data = [];
		$status = 200;
		$userID = trim($session->get('UserID'));
		if ($userID != '')
		{
			$data = $this->getDoctrine()->getRepository('ExampleSampleBundle:User')->find($userID);
		}
		else
		{
			$status = 404;
		}
		$view = $this->view($data,$status);
		return $this->handleView($view);
    }
	
	public function getUserAction()
	{
		$user = new User();
		$user->setUsername('Adam');
		$user->setPassword(sha1('admin'));
		$user->setEmail('avenn77@wp.pl');

		$em = $this->getDoctrine()->getManager();
		$em->persist($user);
		$em->flush();
		
		$view = $this->view($user,200);
		return $this->handleView($view);
	}

	public function postLoginAction(Request $request)
	{
		$session = new Session();
		//$session->start();
		$user = $this->getDoctrine()->getRepository('ExampleSampleBundle:User')->findOneBy(
			array('username' => $request->request->all()['login'], 'password' => sha1($request->request->all()['password']))
		);
		$status = 500;
		
		if (!$user)
		{
			$status = 403;
			$user = [];
		}
		else
		{
			$status = 200;
			$session->set('UserID', $user->getId());	
		}
		
		$view = $this->view($user,$status);
		return $this->handleView($view);
	}
	
	
}
