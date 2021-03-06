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
        return $this->boardDAO->getBoardById($id);
    }

    public function getBoards()
    {
        return $this->boardDAO->getBoards();
    }

    public function getBoardByName($name)
    {
        return $this->boardDAO->getBoardByName($name);
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
    public function updateBoardName($id, $name, $archived){
        return $this->boardDAO->updateBoardName($id, $name, $archived);

    }
    public function getBoardLists($id)
    {
        return $this->getBoardById($id)->getCardList();
    }
}