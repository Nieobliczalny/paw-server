<?php

namespace Example\SampleBundle\DAO;


use Doctrine\ORM\EntityManager;

class UserDAO
{
    public $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    

    public function getUserByUsername($username)
    {
        $user = $this->entityManager->getRepository('ExampleSampleBundle:User')->findBy(array('username' => $username ));
        return $user;
    }

    public function addUser($user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }
    
}