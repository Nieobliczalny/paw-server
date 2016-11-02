<?php

/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-26
 * Time: 23:54
 */
namespace Example\SampleBundle\Services;


use Example\SampleBundle\DAO\BoardDAO;
use Example\SampleBundle\Entity\Board;
use Doctrine\ORM\EntityManager;

class BoardService
{
    protected $boardDAO;
	protected $em;
    public function __construct(EntityManager $entityManager)
    {
		$this->em = $entityManager;
        $this->boardDAO = new BoardDAO($this->em);
    }
    public function getBoardById($id)
    {
        return $this->boardDAO->getBoard($id);
    }

    public function deleteBoardById($id){
        return $this->boardDAO->deleteBoard($id);
    }

    public function addBoard($name)
    {
        $board = new Board();
        $board->setName($name);
        $board->setArchived(false);
        return $this->boardDAO->addBoard($board);
    }
    public function updateBoardName($id, $name){
        return $this->boardDAO->updateBoardName($id, $name);

    }
    public function getBoardLists($id)
    {
        return $this->getBoardById($id)->getCardList();
    }
}