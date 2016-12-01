<?php

namespace Example\SampleBundle\DAO;


use Doctrine\ORM\EntityManager;

class AttachmentDAO
{
    public $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAttachmentById($id)
    {
        $attachment = $this->entityManager->getRepository('ExampleSampleBundle:Attachment')->find($id);
        return $attachment;
    }

    public function addAttachment($attachment){
        $this->entityManager->persist($attachment);
        $this->entityManager->flush();
        return $attachment;
    }

    public function deleteAttachment($attachment)
    {
        $this->entityManager->remove($attachment);
        $this->entityManager->flush();
        return $attachment;
    }
    
}