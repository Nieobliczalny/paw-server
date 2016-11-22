<?php

/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-26
 * Time: 23:51
 */
namespace Example\SampleBundle\DAO;


use Doctrine\ORM\EntityManager;

class CommentDAO
{
    public $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCommentById($id)
    {
        $comment = $this->entityManager->getRepository('ExampleSampleBundle:Comment')->find($id);
        return $comment;
    }

    public function getCommentsByCard($cardId)
    {
        $comments = $this->entityManager->getRepository('ExampleSampleBundle:Comment')->findBy(array('card' => $cardId));
        return $comments;
    }

    public function deleteComment($id)
    {
        $comment = $this->getCommentById($id);
        $this->entityManager->remove($comment);
        $this->entityManager->flush();
        return $comment;
    }
    public function addComment($comment){
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
        return $comment;
    }
    public function updateCommentContent($id, $content)
    {
        $comment = $this->getCommentById($id);
        if($content != '') $comment->setContent($content);
        $this->entityManager->flush();
        return $comment;
    }
}