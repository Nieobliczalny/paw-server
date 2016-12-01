<?php
/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-31
 * Time: 15:38
 */

namespace Example\SampleBundle\Services;


use Example\SampleBundle\DAO\CardDAO;
use Example\SampleBundle\DAO\UserDAO;
use Doctrine\ORM\EntityManager;
use Example\SampleBundle\Entity\Attachment;
use Example\SampleBundle\Entity\Card;


class CardService
{
    protected $cardDAO;
    protected $em;
    protected $cardListService;
    protected $attachmentService;
    public function __construct(EntityManager $entityManager, CardListService $cardListService, AttachmentService $attachmentService, UserService $userService)
    {
        $this->em = $entityManager;
        $this->cardDAO = new CardDAO($this->em);
        $this->cardListService = $cardListService;
        $this->attachmentService =$attachmentService;
        $this->userService = $userService;
    }
    public function getCardById($id)
    {
        return $this->cardDAO->getCard($id);
    }
    public function addCard($cardListId, $name,$description)
    {
        $board = $this->cardListService->getCardListById($cardListId);
        $cardList = new Card();
        $cardList->setName($name)->setCardList($board)->setArchived(false)->setDescription($description)->setPosition($board->getCards()->count());
        return $this->cardDAO->addCard($cardList);
    }
    public function addAttachmentToCard($cardId, $pathToAttachment){
        $attachment = new Attachment();
        $card = $this->cardDAO->getCard($cardId);
        $attachment->setPath($pathToAttachment);
        $attachment->setCard($card);
        return $this->attachmentService->addAttachment($attachment);
    }
    public function updateCard($id, $name, $archived,$description, $cardList_id, $position, $date)
    {
        return $this->cardDAO->updateCard($id, $name, $archived,$description, $cardList_id, $position, $date);
    }
    public function deleteCardById($id)
    {
        return $this->cardDAO->delete($id);
    }
    public function deleteTagFromCard($cardId, $tag)
    {
        return $this->cardDAO->deleteTagFromCard($cardId, $tag);
    }
    public function addUserToCard($userId, $cardId){
        $card = $this->cardDAO->getCard($cardId);
        $user = $this->userDAO->getUserById($userId);
        $card->addSubscription($user);
        $this->em->flush();
    }
}