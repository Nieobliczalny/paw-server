<?php
/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-31
 * Time: 15:37
 */
namespace Example\SampleBundle\DAO;

use Doctrine\ORM\EntityManager;

class CardDAO
{
    public $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCard($id)
    {
        $card = $this->entityManager->getRepository('ExampleSampleBundle:Card')->find($id);
        return $card;
    }
    public function addCard($card){
        $this->entityManager->persist($card);
        $this->entityManager->flush();
        return $card;
    }
    public function updateCard($id, $name, $archived,$description, $cardList_id, $position)
    {
        $card = $this->getCard($id);
        if($name != '') $card->setName($name);
        if($archived != '') $card->setArchived($archived); 
        if($description != '') $card->setDescription($description);
        if($position != '')
		{
			$pos = $card->getPosition();
			$card->getCardList()->getCards()->map(function($p) use($card){ if ($p->getPosition() >= $card->getPosition() && $p->getId() != $card->getId()) $p->setPosition($p->getPosition() - 1); return $p; });
			$card->setPosition(0);
		}
        if($cardList_id != '') $card->setCardList($cardList_id);
		if ($position != '') //Divided into 2 ifs, because cardList can be updated also
		{
			$card->getCardList()->getCards()->map(function($p) use($position, $card){ if ($p->getPosition() >= $position && $p->getId() != $card->getId()) $p->setPosition($p->getPosition() + 1); return $p; });
			$card->setPosition($position);
		}
        $this->entityManager->flush();
        return $card;
    }
    public function delete($id)
    {
        $card = $this->getCard($id);
		if ($card->getArchived())
		{
			$this->entityManager->remove($card);
			$this->entityManager->flush();
		}
        return $card;
    }
    public function deleteTagFromCard($cardId, $tag)
    {
        $card = $this->getCard($cardId);
        $data = $card->removeTag($tag);
        $this->entityManager->persist($card);
        $this->entityManager->flush();
        return $data;
    }
    
}