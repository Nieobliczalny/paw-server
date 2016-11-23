<?php

namespace Example\SampleBundle\DAO;


use Doctrine\ORM\EntityManager;

class EntryDAO
{
    public $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }    

    public function addEntry($entry){
        $this->entityManager->persist($entry);
        $this->entityManager->flush();
        return $entry;
    }
    
}