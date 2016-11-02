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
        $cardList = $this->entityManager->getRepository('ExampleSampleBundle:Card')->find($id);
        return $cardList;
    }
    public function addCard($cardList){
        $this->entityManager->persist($cardList);
        $this->entityManager->flush();
        return $cardList;
    }
    public function updateCard($id, $name)
    {
        $cardList = $this->getCard($id);
        $cardList->setName($name);
        $this->entityManager->flush();
        return $cardList;
    }
    public function delete($id)
    {
        $cardList = $this->getCard($id);
        $this->entityManager->remove($cardList);
        $this->entityManager->flush();
        return $cardList;
    }
}