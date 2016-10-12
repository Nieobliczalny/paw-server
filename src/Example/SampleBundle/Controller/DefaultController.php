<?php

namespace Example\SampleBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

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
    public function getBoardsAction()
    {
        $data = [[
			'id' => '1',
			'name' => 'Board 1',
		]];
		$view = $this->view($data,200);
		return $this->handleView($view);
    }
    public function getBoardAction($id)
    {
        $data = [
			'id' => '1',
			'name' => 'Board 1',
		];
		$view = $this->view($data,200);
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
        $data = [
			'name' => 'User001',
		];
		$view = $this->view($data,200);
		return $this->handleView($view);
    }
}
