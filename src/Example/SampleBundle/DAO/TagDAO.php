<?php

/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-26
 * Time: 23:51
 */
namespace Example\SampleBundle\DAO;


use Doctrine\ORM\EntityManager;

class TagDAO
{
    public $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getTagById($id)
    {
        $tag = $this->entityManager->getRepository('ExampleSampleBundle:Tag')->find($id);
        return $tag;
    }

    public function deleteTag($id)
    {
        $tag = $this->getTagById($id);
        $this->entityManager->remove($tag);
        $this->entityManager->flush();
        return $tag;
    }
    public function addTag($tag){
        $this->entityManager->persist($tag);
        $this->entityManager->flush();
        return $tag;
    }
    public function updateTag($id, $colour, $content)
    {
        $tag = $this->getTagById($id);
        if($colour != '') $tag->setColour($colour);
        $tag->setContent($content);
        $this->entityManager->flush();
        return $tag;
    }
}