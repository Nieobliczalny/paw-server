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
    

    public function getUserById($id)
    {
        $user = $this->entityManager->getRepository('ExampleSampleBundle:User')->find($id);
        return $user;
    }

    public function addUser($user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }

    public function updateUser($id, $username, $email, $password)
    {
        $user = getUserById($id);
        if($username != '') $user->setUsername($username);
        if($email != '') $user->setEmail($email);
        if($password != '') $user->setPassword($password);
        $this->entityManager->flush();
        return $user;

    }
    
}