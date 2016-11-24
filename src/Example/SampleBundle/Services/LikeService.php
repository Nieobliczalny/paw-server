<?php

/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-26
 * Time: 23:54
 */
namespace Example\SampleBundle\Services;


use Example\SampleBundle\DAO\LikeDAO;
use Example\SampleBundle\Entity\Like;
use Doctrine\ORM\EntityManager;

class LikeService
{
    protected $likeDAO;
	protected $em;
    protected $boardService;
    protected $userService;
    public function __construct(EntityManager $entityManager, BoardService $boardService, UserService $userService)
    {
		$this->em = $entityManager;
        $this->likeDAO = new LikeDAO($this->em);
        $this->boardService = $boardService;
        $this->userService = $userService;
    }

    public function checkLikeByBoardAndUser($boardId, $userId)
    {
        return $this->likeDAO->checkLike($boardId, $userId);
    }

    public function deleteLikeById($id){
        return $this->likeDAO->deleteLike($id);
    }

    public function addLike($boardId, $userId)
    {
        $like = new Like();
        $board = $this->boardService->getBoardById($boardId);
        $user = $this->userService->getUserById($userId);
        $like->setBoard($board);
        $like->setUser($user);
        return $this->likeDAO->addLike($like);
    }
    public function getLikesByBoard($boardId){
        return $this->likeDAO->getLikesByBoard($boardId);
    }
    public function getLikeById($id){
        return $this->likeDAO->getLikeById($id);
    }
}