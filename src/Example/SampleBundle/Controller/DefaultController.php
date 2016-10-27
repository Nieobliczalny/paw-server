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

class DefaultController extends FOSRestController 
{
    protected $boardService;

    public function __construct()
    {
        $this->boardService = new BoardService();
    }
    
	public function deleteBoardAction($id)
    {
        $b = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:Board')
        ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($b);
        $em->flush();

        $view = $this->view($b,200);
        return $this->handleView($view);
    }

    public function postBoardAction(Request $request)
    {
        $name = $request->request->all()['name'];
		$board = new Board();
        $board->setName($name);

        $em = $this->getDoctrine()->getManager();
        $em->persist($board);
        $em->flush();

        $view = $this->view($board,200);
        return $this->handleView($view);
    }

	public function putBoardAction($id, Request $request)
    {
		$b = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:Board')
        ->find($id);
        $name = $request->request->all()['name'];		
        $b->setName($name);

        $em = $this->getDoctrine()->getManager();       
        $em->flush();

        $view = $this->view($b,200);
        return $this->handleView($view);	
    }

	  public function getBoardAction($id)
    {
		$b = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:Board')
        ->find($id);
        
		$view = $this->view($b,200);
		return $this->handleView($view);
    }

	  public function getBoardsAction()
    {
		$b = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:Board')->findAll();
        
		$view = $this->view($b,200);
		return $this->handleView($view);
    }

	public function postListAction(Request $request)
    {
        $name = $request->request->all()['name'];
		$boardId = $request->request->all()['boardID'];
		$board = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:Board')
        ->find($boardId);

		$list = new CardList();
        $list->setName($name);
		$list->setBoard($board);
		$list->setArchived(false);

        $em = $this->getDoctrine()->getManager();
        $em->persist($list);
        $em->flush();

        $view = $this->view($list,200);
        return $this->handleView($view);
    }

	public function putListAction($id, Request $request)
    {
        $name = $request->request->all()['name'];
		$list = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:CardList')
        ->find($id);
		
        $list->setName($name);		

        $em = $this->getDoctrine()->getManager();        
        $em->flush();

        $view = $this->view($list,200);
        return $this->handleView($view);
    }

	public function deleteListAction($id)
    {
        $l = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:CardList')
        ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($l);
        $em->flush();

        $view = $this->view($l,200);
        return $this->handleView($view);
    }

	public function getListAction($id)
    {
		$l = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:CardList')
        ->find($id);
        
		$view = $this->view($l,200);
		return $this->handleView($view);
    }

	public function getListsAction()
    {
		$l = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:CardList')
        ->findAll();
        
		$view = $this->view($l,200);
		return $this->handleView($view);
    }

    public function getBoardListsAction($id)
    {      

		$l = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:CardList')->findBy(array('board' => $id ));
		$view = $this->view($l,200);
		return $this->handleView($view);
    }


    public function postCardAction(Request $request)
    {
        $name = $request->request->all()['name'];
		$listId = $request->request->all()['listID'];
		$list = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:CardList')
        ->find($listId);

		$card = new Card();
        $card->setName($name);
		$card->setCardList($list);
		$card->setArchived(false);

        $em = $this->getDoctrine()->getManager();
        $em->persist($card);
        $em->flush();

        $view = $this->view($card,200);
        return $this->handleView($view);
    }

    public function putCardAction($id, Request $request)
    {
        $name = $request->request->all()['name'];
		$card = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:Card')
        ->find($id);
		
        $card->setName($name);		

        $em = $this->getDoctrine()->getManager();        
        $em->flush();

        $view = $this->view($card,200);
        return $this->handleView($view);
    }

    public function deleteCardAction($id)
    {
        $c = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:Card')
        ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($c);
        $em->flush();

        $view = $this->view($c,200);
        return $this->handleView($view);
    }

    public function getCardAction($id)
    {
		$c = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:Card')
        ->find($id);
        
		$view = $this->view($c,200);
		return $this->handleView($view);
    }

    public function getCardsAction()
    {
		$c = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:Card')
        ->findAll();
        
		$view = $this->view($c,200);
		return $this->handleView($view);
    }
    
    public function getListsCardsAction($id)
    {
		$c = $this->getDoctrine()
        ->getRepository('ExampleSampleBundle:Card')->findBy(array('cardList' => $id ));
		$view = $this->view($c,200);
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
