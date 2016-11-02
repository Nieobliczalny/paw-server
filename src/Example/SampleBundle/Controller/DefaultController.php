<?php

namespace Example\SampleBundle\Controller;

use Example\SampleBundle\Entity\User;
use Example\SampleBundle\Entity\Board;
use Example\SampleBundle\Entity\CardList;
use Example\SampleBundle\Entity\Card;
use Example\SampleBundle\Entity\Task;
use Example\SampleBundle\Services\BoardService;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DefaultController extends FOSRestController
{
    protected $boardService;
    protected $cardListService;
    protected $cardService;
    protected $taskService;


    public function __construct()
    {

    }

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->boardService = $container->get('example.sample.boardservice');
        $this->cardListService = $container->get('example.sample.cardlistservice');
        $this->cardService = $container->get('example.sample.cardservice');
        $this->taskService = $container->get('example.sample.taskservice');

    }

    public function getBoardAction($id)
    {
        $board = $this->boardService->getBoardById($id);
        $view = $this->view($board, 200);
        return $this->handleView($view);
    }

    public function getSearchBoardAction($name)
    {
        $board = $this->boardService->getBoardByName($name);
        $view = $this->view($board, 200);
        return $this->handleView($view);
    }

    public function deleteBoardAction($id)
    {
        $view = $this->view($this->boardService->deleteBoardById($id), 200);
        return $this->handleView($view);
    }

    public function postBoardAction(Request $request)
    {
        $name = $request->request->all()['name'];
        $view = $this->view($this->boardService->addBoard($name), 200);
        return $this->handleView($view);
    }

    public function putBoardAction($id, Request $request)
    {
        $name = $request->request->all()['name'];
        $view = $this->view($this->boardService->updateBoardName($id, $name), 200);
        return $this->handleView($view);
    }


    public function postListAction(Request $request)
    {
        $name = $request->request->all()['name'];
        $boardId = $request->request->all()['boardID'];
        $view = $this->view($this->cardListService->addCardList($boardId, $name), 200);
        return $this->handleView($view);
    }

    public function putListAction($id, Request $request)
    {
		$requestData = $request->request->all();
        $name = $this->checkIfPropertyExists($requestData, 'name') ? $requestData['name'] : '';
        $archived = $this->checkIfPropertyExists($requestData, 'archived') ? $requestData['archived'] : '';
        $view = $this->view($this->cardListService->updateCardList($id, $name, $archived),200);
        return $this->handleView($view);
    }

    public function deleteListAction($id)
    {
		if (!$this->cardListService->getCardListById($id)->getArchived()) $view = $this->view('List not archived', 403);
        else $view = $this->view($this->cardListService->deleteCardListById($id),200);
        return $this->handleView($view);
    }

    public function getListAction($id)
    {
        $view = $this->view($this->cardListService->getCardListById($id),200);
        return $this->handleView($view);
    }

    public function postCardAction(Request $request)
    {
        $name = $request->request->all()['name'];
        $cardListId = $request->request->all()['cardListID'];
        $description = $request->request->all()['description'];
        $view = $this->view($this->cardService->addCard($cardListId, $name, $description), 200);
        return $this->handleView($view);
    }

    public function putCardAction($id, Request $request)
    {
        $requestData = $request->request->all();
        $name = $this->checkIfPropertyExists($requestData, 'name') ? $requestData['name'] : '';
        $archived = $this->checkIfPropertyExists($requestData, 'archived') ? $requestData['archived'] : '';
        $description = $this->checkIfPropertyExists($requestData, 'description') ? $requestData['description'] : '';
        $view = $this->view($this->cardService->updateCard($id, $name, $archived, $description),200);
        return $this->handleView($view);
    }


    public function deleteCardAction($id)
    {
		if (!$this->cardService->getCardById($id)->getArchived()) $view = $this->view('Card not archived', 403);
        else $view = $this->view($this->cardService->deleteCardById($id),200);
        return $this->handleView($view);
    }

    public function getCardAction($id)
    {
        $view = $this->view($this->cardService->getCardById($id),200);
        return $this->handleView($view);
    }
    public function postTaskAction(Request $request)
    {
        $name = $request->request->all()['name'];
        $cardId = $request->request->all()['cardID'];
        $view = $this->view($this->taskService->addTask($cardId, $name), 200);
        return $this->handleView($view);
    }

    public function putTaskAction($id, Request $request)
    {
        $name = $request->request->all()['name'];
        $view = $this->view($this->taskService->updateTaskName($id, $name),200);
        return $this->handleView($view);
    }

    public function deleteTaskAction($id)
    {
        $view = $this->view($this->taskService->deleteTaskById($id),200);
        return $this->handleView($view);
    }

    public function getTaskAction($id)
    {
        $view = $this->view($this->taskService->getTaskById($id),200);
        return $this->handleView($view);
    }

    public function getBoardListsAction($id)
    {
        $view = $this->view($this->boardService->getBoardLists($id),200);
        return $this->handleView($view);
    }


    public function getListsCardsAction($listID)
    {
        $view = $this->view($this->cardListService->getCardListById($listID)->getCards(),200);
        return $this->handleView($view);
    }

    public function getCardTasks($cardID)
    {
        $view = $this->view($this->cardService->getCardById($cardID)->getTasks(),200);
        return $this->handleView($view);
    }

    public function postUserAction(Request $request)
    {        
        $requestData = $request->request->all();
        $username = $this->checkIfPropertyExists($requestData, 'username') ? $requestData['username'] : '';
        $email = $this->checkIfPropertyExists($requestData, 'email') ? $requestData['email'] : '';
        $login = $this->checkIfPropertyExists($requestData, 'login') ? $requestData['login'] : '';
        $password = $this->checkIfPropertyExists($requestData, 'password') ? sha1($requestData['password']) : '';
        $view = $this->view($this->userService->addUser($username, $login, $email, $password), 200);
        return $this->handleView($view);
    }

    public function putUserAction($id, Request $request)
    {
        $username = $request->request->all()['username'];        
        $email = $request->request->all()['email'];
        $password = sha1($request->request->all()['password']);

        $view = $this->view($this->userService->updateUser($id, $username, $email, $password),200);
        return $this->handleView($view);
    }

    public function getUserAction($id)
    {
        $view = $this->view($this->userService->getUserById($id),200);
        return $this->handleView($view);
    }

    



    /*

    public function getListsCardsAction($id)
    {
        $c = $this->getDoctrine()
            ->getRepository('ExampleSampleBundle:Card')->findBy(array('cardList' => $id ));
        $view = $this->view($c,200);
        return $this->handleView($view);
    }

/////////////////////////////////////////////////////////////
    public function getExampleAction()
    {
        $data = [
			'value1' => 'Test2',
			'value2' => '300',
		];
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
    */
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

    	  public function getBoardsAction()
     {
 		$b = $this->getDoctrine()
         ->getRepository('ExampleSampleBundle:Board')->findAll();
         
 		$view = $this->view($b,200);
 		return $this->handleView($view);
     }
	
	protected function checkIfPropertyExists($obj, $key)
	{
		if (is_array($obj) && array_key_exists($key, $obj)) return true;
		if (is_object($obj) && property_exists($obj, $key)) return true;
		return false;
	}
	
}
