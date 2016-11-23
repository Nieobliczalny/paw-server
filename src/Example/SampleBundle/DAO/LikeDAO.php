<?php

/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-26
 * Time: 23:51
 */
namespace Example\SampleBundle\DAO;


use Doctrine\ORM\EntityManager;

class LikeDAO
{
    public $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getLikeById($id)
    {
        $like = $this->entityManager->getRepository('ExampleSampleBundle:Like')->find($id);
        return $like;
    }

    public function deleteLike($id)
    {
        $like = $this->getLikeById($id);
        $this->entityManager->remove($like);
        $this->entityManager->flush();
        return $like;
    }
    public function addLike($like){
        $this->entityManager->persist($like);
        $this->entityManager->flush();
        return $like;
    }
    public function checkLike($boardId, $userId)
    {
        $board = $this->entityManager->getRepository('ExampleSampleBundle:Board')->findBy(array('board' => $boardId, 'user' => $userId ));
        if($board == null)
            return false;
        return true;
    }
    public function getLikesByBoard($boardId){
        return $this->entityManager->getRepository('ExampleSampleBundle:Like')->findBy(array('board' => $boardId));
    }
}