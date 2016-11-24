<?php

/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-26
 * Time: 23:54
 */
namespace Example\SampleBundle\Services;


use Example\SampleBundle\DAO\CommentDAO;
use Example\SampleBundle\Entity\Board;
use Example\SampleBundle\Entity\Comment;
use Doctrine\ORM\EntityManager;

class CommentService
{
    protected $commentDAO;
	protected $em;
    protected $cardService;
    protected $userService;
    public function __construct(EntityManager $entityManager, CardService $cardService, UserService $userService)
    {
		$this->em = $entityManager;
        $this->commentDAO = new CommentDAO($this->em);
        $this->cardService = $cardService;
        $this->userService = $userService;
    }

    public function getCommentsByCard($cardId)
    {
        return $this->commentDAO->getCommentsByCard($cardId);
    }

    public function deleteCommentById($id){
        return $this->commentDAO->deleteComment($id);
    }

    public function addComment($content, $cardId, $userId)
    {
        $comment = new Comment();
        $comment->setContent($content);
        $card = $this->cardService->getCardById($cardId) ;
        $comment->setCard($card);
        $user = $this->userService->getUserById($userId);
        $comment->setUser($user);
        $time = new \DateTime();
        $time->format('H:i:s \O\n d.m.Y'); 
        $comment->setReportDate($time);      
        return $this->commentDAO->addComment($comment);
    }
    public function updateCommentContent($id, $content){
        return $this->commentDAO->updateCommentContent($id, $content);

    }
}