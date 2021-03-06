<?php
/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-31
 * Time: 15:37
 */
namespace Example\SampleBundle\DAO;

use Doctrine\ORM\EntityManager;

class CardListDAO
{
    public $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCardList($id)
    {
        $cardList = $this->entityManager->getRepository('ExampleSampleBundle:CardList')->find($id);
        return $cardList;
    }
    public function addCardList($cardList){
        $this->entityManager->persist($cardList);
        $this->entityManager->flush();
        return $cardList;
    }
    public function updateCardList($id, $name, $archived)
    {
        $cardList = $this->getCardList($id);
        if($name != '') $cardList->setName($name);
        if($archived != '') $cardList->setArchived($archived);
        $this->entityManager->flush();
        return $cardList;
    }
    
    public function delete($id)
    {
        $cardList = $this->getCardList($id);
		if ($cardList->getArchived())
		{
			$this->entityManager->remove($cardList);
			$this->entityManager->flush();
		}
        return $cardList;
    }
}