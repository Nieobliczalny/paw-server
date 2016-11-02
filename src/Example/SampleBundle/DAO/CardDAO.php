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
    public function updateCard($id, $name)
    {
        $card = $this->getCard($id);
        if($name != '') $card->setName($name);
        if($archived != '') $card->setArchived($archived);       
        $this->entityManager->flush();
        return $card;
    }
    public function delete($id)
    {
        $card = $this->getCard($id);
        $this->entityManager->remove($card);
        $this->entityManager->flush();
        return $card;
    }
    
}