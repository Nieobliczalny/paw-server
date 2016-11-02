<?php

namespace Example\SampleBundle\Services;


use Example\SampleBundle\DAO\UserDAO;
use Example\SampleBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class UserService
{
    protected $userDAO;
	protected $em;
    public function __construct(EntityManager $entityManager)
    {
		$this->em = $entityManager;
        $this->userDAO = new UserDAO($this->em);
    }
    
    public function addUser($username, $login, $email, $password)
    {        
        $user = new User();
        $user->setUsername($username);
        $user->setLogin($login);
        $user->setEmail($email);
        $user->setPassword($password); 
        
        
        return $this->userDAO->addUser($user);    
    }

    public function updateUser($id, $username, $email, $password)
    {
        return $this->userDAO->updateUser($id, $username, $email, $password);
    }


}