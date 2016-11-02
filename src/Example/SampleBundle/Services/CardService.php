<?php
/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-31
 * Time: 15:38
 */

namespace Example\SampleBundle\Services;


use Example\SampleBundle\DAO\CardDAO;
use Doctrine\ORM\EntityManager;
use Example\SampleBundle\Entity\Card;


class CardService
{
    protected $cardDAO;
    protected $em;
    protected $cardListService;
    public function __construct(EntityManager $entityManager, CardListService $cardListService)
    {
        $this->em = $entityManager;
        $this->cardDAO = new CardDAO($this->em);
        $this->cardListService = $cardListService;

    }
    public function getCardById($id)
    {
        return $this->cardDAO->getCard($id);
    }
    public function addCard($cardListId, $name)
    {
        $board = $this->cardListService->getCardListById($cardListId);
        $cardList = new Card();
        $cardList->setName($name)->setCardList($board)->setArchived(false);
        return $this->cardDAO->addCard($cardList);
    }
    public function updateCardName($id, $name)
    {
        return $this->cardDAO->updateCard($id, $name);
    }
    public function deleteCardById($id)
    {
        return $this->cardDAO->delete($id);
    }
}