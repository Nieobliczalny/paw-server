<?php
/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-31
 * Time: 15:38
 */

namespace Example\SampleBundle\Services;


use Example\SampleBundle\DAO\CardListDAO;
use Doctrine\ORM\EntityManager;
use Example\SampleBundle\Entity\CardList;

class CardListService
{
    protected $cardListDAO;
    protected $em;
    protected $boardService;
    public function __construct(EntityManager $entityManager, BoardService $boardService)
    {
        $this->em = $entityManager;
        $this->cardListDAO = new CardListDAO($this->em);
        $this->boardService = $boardService;
    }
    public function getCardListById($id)
    {
        return $this->cardListDAO->getCardList($id);
    }
    public function addCardList($boardId, $name)
    {
        $lists = $this->boardService->getBoardLists($boardId);
        $cardList = new CardList();
        $cardList->setName($name)->setBoard($boardId)->setArchived(false);
        return $this->cardListDAO->addCardList($cardList);
    }
    public function updateCardListName($id, $name)
    {
        return $this->cardListDAO->updateCardList($id, $name);
    }

    public function updateCardListArchived($id)
    {
        return $this->cardListDAO->updateCardListArchived($id);
    }
    public function deleteCardListById($id)
    {
        return $this->cardListDAO->delete($id);
    }
}