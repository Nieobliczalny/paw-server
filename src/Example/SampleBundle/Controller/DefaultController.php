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
    protected $userService;
    protected $likeService;
    protected $commentService;
    protected $tagService;    
    protected $entryService;


    public function __construct()
    {
        //$date = date('m/d/Y h:i:s a', time());
    }

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->boardService = $container->get('example.sample.boardservice');
        $this->cardListService = $container->get('example.sample.cardlistservice');
        $this->cardService = $container->get('example.sample.cardservice');
        $this->taskService = $container->get('example.sample.taskservice');
        $this->userService = $container->get('example.sample.userservice');
        $this->likeService = $container->get('example.sample.likeservice');
        $this->commentService = $container->get('example.sample.commentservice');
        $this->tagService = $container->get('example.sample.tagservice');
        $this->entryService = $container->get('example.sample.entryservice');        

    }

    public function getBoardAction($id)
    {
        $board = $this->boardService->getBoardById($id);
        $view = $this->view($board, 200);
        return $this->handleView($view);
    }

    public function getBoardsAction()
    {       
 		$view = $this->view($this->boardService->getBoards(),200);
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
		$board = $this->boardService->addBoard($name);
        $view = $this->view($board, 200);
        $content = "Add new board ".$name;
        $this->entryService->addEntry($content,$board);
        return $this->handleView($view);
    }

    public function putBoardAction($id, Request $request)
    {
		$requestData = $request->request->all();
        $board = $this->boardService->getBoardById($id);
        $boardOldName = $board->getName();
        $name = $this->checkIfPropertyExists($requestData, 'name') ? $requestData['name'] : '';
        $archived = $this->checkIfPropertyExists($requestData, 'archived') ? $requestData['archived'] : '';
        $view = $this->view($this->boardService->updateBoardName($id, $name, $archived), 200);  
        $content = "Modyfied board ".$boardOldName;
        $this->entryService->addEntry($content,$board);
        return $this->handleView($view);
    }


    public function postListAction(Request $request)
    {
        $name = $request->request->all()['name'];
        $boardId = $request->request->all()['boardID'];
        $list = $this->cardListService->addCardList($boardId, $name);
        $view = $this->view($list, 200);
        
        $board = $this->boardService->getBoardById($boardId);
        $boardName = $board->getName();
        $content = "Add new list ".$name." to board ".$boardName;
        $this->entryService->addEntry($content,$board);
        return $this->handleView($view);
    }

    public function putListAction($id, Request $request)
    {
        $list = $this->cardListService->getCardListById($id);
        $listOldName = $list->getName();
        $boardId = $list->getBoard();
        $board = $this->boardService->getBoardById($boardId);
        $boardName = $board->getName();

		$requestData = $request->request->all();
        $name = $this->checkIfPropertyExists($requestData, 'name') ? $requestData['name'] : '';
        $archived = $this->checkIfPropertyExists($requestData, 'archived') ? $requestData['archived'] : '';
        $list = $this->cardListService->updateCardList($id, $name, $archived);
        $view = $this->view($list,200);
        
        $content = "Modyfied list ".$listOldName." in ".$boardName;
        $this->entryService->addEntry($content,$board);
        return $this->handleView($view);
    }

    public function deleteListAction($id)
    {
		if (!$this->cardListService->getCardListById($id)->getArchived()) $view = $this->view('List not archived', 403);
        else
        {
            $list = $this->cardListService->getCardListById($id);
            $listOldName = $list->getName();
            $boardId = $list->getBoard();
            $board = $this->boardService->getBoardById($boardId);
            $boardName = $board->getName();
            $view = $this->view($this->cardListService->deleteCardListById($id),200);
            $content = "Delete list ".$listOldName." in ".$boardName;
            $this->entryService->addEntry($content,$board);
            
        }
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
        $card = $this->cardService->addCard($cardListId, $name, $description);
        $view = $this->view($card, 200);
        
        $list = $this->cardListService->getCardListById($cardListId);
        $listName = $list->getName();
        $boardId = $list->getBoard();
        $board = $this->boardService->getBoardById($boardId);
        $boardName = $board->getName();
        $content = "Add new card ".$name." to list ".$listName." to board ".$boardName;
        $this->entryService->addEntry($content,$board);
        return $this->handleView($view);
    }

    public function putCardAction($id, Request $request)
    {
        $card = $this->cardService->getCardById($id);
        $cardOldName = $card->getName();
        $cardListId = $card->getCardList();        
        $list = $this->cardListService->getCardListById($cardListId);
        $listName = $list->getName();
        $boardId = $list->getBoard();
        $board = $this->boardService->getBoardById($boardId);
        $boardName = $board->getName();

        $requestData = $request->request->all();
        $name = $this->checkIfPropertyExists($requestData, 'name') ? $requestData['name'] : '';
        $archived = $this->checkIfPropertyExists($requestData, 'archived') ? $requestData['archived'] : '';
        $description = $this->checkIfPropertyExists($requestData, 'description') ? $requestData['description'] : '';
        $cardList_id = $this->checkIfPropertyExists($requestData, 'cardList_id') ? $this->cardListService->getCardListById($requestData['cardList_id']) : '';
        $position = $this->checkIfPropertyExists($requestData, 'position') ? $requestData['position'] : '';

        $view = $this->view($this->cardService->updateCard($id, $name, $archived, $description, $cardList_id, $position),200);
        $content = "Modyfied card ".$cardOldName." in list ".$listName." in board ".$boardName;
        $this->entryService->addEntry($content,$board);
        return $this->handleView($view);
    }


    public function deleteCardAction($id)
    {
		if (!$this->cardService->getCardById($id)->getArchived()) $view = $this->view('Card not archived', 403);
        else
        {
            $card = $this->cardService->getCardById($id);
            $cardOldName = $card->getName();
            $cardListId = $card->getCardList(); 
            $list = $this->cardListService->getCardListById($id);
            $listOldName = $list->getName();
            $boardId = $list->getBoard();
            $board = $this->boardService->getBoardById($boardId);
            $boardName = $board->getName();



             $view = $this->view($this->cardService->deleteCardById($id),200);
             $content = "Delete card ".$cardOldName." in list ".$listOldName." in ".$boardName;
             $this->entryService->addEntry($content,$board);
        }
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
    public function postLikeAction(Request $request){
		$session = new Session();
		$userID = trim($session->get('UserID'));
		if ($userID != '')
		{
			$requestData = $request->request->all();
			$boardId = $this->checkIfPropertyExists($requestData, 'boardId') ? $requestData['boardId'] : '';
			$view = $this->view($this->likeService->addLike($boardId, $userID), 200);

            $board = $this->boardService->getBoardById($boardId);
            $boardName = $board->getName();
            $user = $this->userService->getUserById($userID);
            $userName = $user->getUsername();
            $content = "Add like by ".$userName." to board ".$boardName;
            $this->entryService->addEntry($content,$board);


		}
		else
		{
			$data = [];
			$view = $this->view($data, 401);
		}
        return $this->handleView($view);
    }
    public function deleteLikeAction($likeId){
        $like = $this->likeService->getLikeById($likeId);
        $boardId = $like->getBoard();
        $userID = $like->getUser();
        $board = $this->boardService->getBoardById($boardId);
        $boardName = $board->getName();
        $user = $this->userService->getUserById($userID);
        $userName = $user->getUsername();

        $view = $this->view($this->likeService->deleteLikeById($likeId), 200);
        $content = "Delete like from user ".$userName." in board ".$boardName;
        $this->entryService->addEntry($content,$board);

        return $this->handleView($view);
    }
    public function checkBoardUserLikeAction($boardId, $userId)
    {
        $view = $this->view($this->likeService->checkLikeByBoardAndUser($boardId, $userId), 200);
        return $this->handleView($view);
    }
    public function getBoardLikesAction($boardId){

        $view = $this->view($this->likeService->getLikesbyBoard($boardId), 200);
        return $this->handleView($view);
    }

    public function getCardCommentsAction($cardId){
        $view = $this->view($this->commentService->getCommentsByCard($cardId), 200);
        return $this->handleView($view);
    }

    public function deleteCommentAction($commentId){
        $comment = $this->commentService->getCommentById($commentId);
        $commentContent = $comment->getContent();
        $cardId = $comment->getCard();
        $card = $this->cardService->getCardById($cardId);
        $cardOldName = $card->getName();
        $cardListId = $card->getCardList(); 
        $list = $this->cardListService->getCardListById($cardListId);
        $listOldName = $list->getName();
        $boardId = $list->getBoard();
        $board = $this->boardService->getBoardById($boardId);
        $boardName = $board->getName();

        $view = $this->view($this->commentService->deleteCommentById($commentId), 200);

        $content = "Delete comment ".$commentContent." from card ".$cardOldName." in list ".$listOldName." in ".$boardName;
        $this->entryService->addEntry($content,$board);
        return $this->handleView($view);
    }

    public function postCommentAction(Request $request){
		$session = new Session();
		$userID = trim($session->get('UserID'));
		//var_dump( $request->request->all());
		if ($userID != '')
		{
			$content = $request->request->all()['content'];
			$cardId = $request->request->all()['cardId'];
            $comment = $this->commentService->addComment($content, $cardId, $userID);
			$view = $this->view($comment, 200);

            $cardId = $comment->getCard();
            $card = $this->cardService->getCardById($cardId);
            $cardOldName = $card->getName();
            $cardListId = $card->getCardList(); 
            $list = $this->cardListService->getCardListById($cardListId);
            $listOldName = $list->getName();
            $boardId = $list->getBoard();
            $board = $this->boardService->getBoardById($boardId);
            $boardName = $board->getName();
            $content = "Add comment ".$content." to card ".$cardOldName." in list ".$listOldName." in ".$boardName;
            $this->entryService->addEntry($content,$board);

		}
		else
		{
			$data = [];
			$view = $this->view($data, 401);
		}
        return $this->handleView($view);
    }
    public function putCommentAction(Request $request, $commentId){
        $content = $request->request->all()['content'];

        $comment = $this->commentService->getCommentById($commentId);
        $commentContent = $comment->getContent();
        $cardId = $comment->getCard();
        $card = $this->cardService->getCardById($cardId);
        $cardOldName = $card->getName();
        $cardListId = $card->getCardList(); 
        $list = $this->cardListService->getCardListById($cardListId);
        $listOldName = $list->getName();
        $boardId = $list->getBoard();
        $board = $this->boardService->getBoardById($boardId);
        $boardName = $board->getName();

        $view = $this->view($this->commentService->updateCommentContent($commentId, $content), 200);
        $content = "Modyfied comment ".$commentContent." from card ".$cardOldName." in list ".$listOldName." in ".$boardName;
        $this->entryService->addEntry($content,$board);
        return $this->handleView($view);
    }

    public function putTagAction(Request $request, $tagId)
    {
        $content = $request->request->all()['content'];
        $colour = $request->request->all()['colour'];
        $view = $this->view($this->tagService->updateTag($tagId,$colour,$content), 200);
        return $this->handleView($view);
    }

    public function deleteTagAction($tagId)
    {
        $tag = $this->tagService->deleteTagById($tagId);
        $content = $tag->getContent();
        $view = $this->view($tag, 200);
        $boardId = $tag->getBoard();
        $board = $this->boardService->getBoardById($boardId);
        $boardName = $board->getName();
        $content = "Delete tag ".$content." from board ".$boardName;
        $this->entryService->addEntry($content,$board);
        return $this->handleView($view);
    }

    public function deleteCardTagAction($cardId,$tagId)
    {
        $view = $this->view($this->cardService->deleteTagFromCard($cardId, $this->tagService->getTagById($tagId)), 200);
        return $this->handleView($view);
    }

    public function postTagAction(Request $request){
        $content = $request->request->all()['content'];
        $colour = $request->request->all()['colour'];
        $boardId = $request->request->all()['boardId'];
        $tag = $this->tagService->addTag($boardId,$colour,$content);
        $view = $this->view($tag, 200);

        $board = $this->boardService->getBoardById($boardId);
        $boardName = $board->getName();
        $content = "Add new tag ".$content." to board ".$boardName;
        $this->entryService->addEntry($content,$board);

        return $this->handleView($view);
    }

    public function postCardTagAction(Request $request, $cardId){
        $tagId = $request->request->all()['tagId'];
        $view = $this->view($this->tagService->addTagToCard($tagId, $cardId), 200);
        return $this->handleView($view);
    }

    public function getBoardTagsAction($boardId)
    {
        $view = $this->view($this->tagService->getTagsByBoard($boardId), 200);
        return $this->handleView($view);
    }

    public function getCardTagsAction($cardId){
        $view = $this->view($this->tagService->getTagsByCard($cardId), 200);
        return $this->handleView($view);
    }

    public function getBoardEntryAction($boardId){
        $view = $this->view($this->entryService->getEntryByBoard($boardId), 200);
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

	public function postLogoutAction(Request $request)
	{
		$session = new Session();
		//$session->start();
		$user = $this->getDoctrine()->getRepository('ExampleSampleBundle:User')->findOneBy(
			array('id' => intval($session->get('UserID')))
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
			$session->remove('UserID');	
		}
		
		$view = $this->view($user,$status);
		return $this->handleView($view);
	}

    
	
	protected function checkIfPropertyExists($obj, $key)
	{
		if (is_array($obj) && array_key_exists($key, $obj)) return true;
		if (is_object($obj) && property_exists($obj, $key)) return true;
		return false;
	}
	
}
