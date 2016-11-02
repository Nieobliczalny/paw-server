<?php

/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-26
 * Time: 23:51
 */
namespace Example\SampleBundle\DAO;


use Doctrine\ORM\EntityManager;

class BoardDAO
{
    public $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getBoardById($id)
    {
        $board = $this->entityManager->getRepository('ExampleSampleBundle:Board')->find($id);
        return $board;
    }

    public function getBoards()
    {
        $board = $this->entityManager->getRepository('ExampleSampleBundle:Board')->findAll();
        return $board;
    }

    public function getBoardByName($name)
    {
        $board = $this->entityManager->getRepository('ExampleSampleBundle:Board')->findBy(array('name' => $name ));
        return $board;
    }

    public function deleteBoard($id)
    {
        $board = $this->getBoardById($id);
        $this->entityManager->remove($board);
        $this->entityManager->flush();
        return $board;
    }
    public function addBoard($board){
        $this->entityManager->persist($board);
        $this->entityManager->flush();
        return $board;
    }
    public function updateBoardName($id, $name)
    {
        $board = $this->getBoardById($id);
        $board->setName($name);
        $this->entityManager->flush();
        return $board;
    }
}