<?php
/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-31
 * Time: 15:37
 */
namespace Example\SampleBundle\DAO;

use Doctrine\ORM\EntityManager;

class TaskDAO
{
    public $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getTask($id)
    {
        $task = $this->entityManager->getRepository('ExampleSampleBundle:Task')->find($id);
        return $task;
    }
    public function addTask($card){
        $this->entityManager->persist($card);
        $this->entityManager->flush();
        return $card;
    }
    public function updateTask($id, $name)
    {
        $cardList = $this->getTask($id);
        $cardList->setName($name);
        $this->entityManager->flush();
        return $cardList;
    }
    public function delete($id)
    {
        $task = $this->getTask($id);
        $this->entityManager->remove($task);
        $this->entityManager->flush();
        return $task;
    }
}