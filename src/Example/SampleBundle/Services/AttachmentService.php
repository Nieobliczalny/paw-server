<?php

namespace Example\SampleBundle\Services;


use Example\SampleBundle\DAO\AttachmentDAO;
use Example\SampleBundle\Entity\Attachment;
use Doctrine\ORM\EntityManager;

class AttachmentService
{
    protected $AttachmentDAO;
	protected $em;
    
    public function __construct(EntityManager $entityManager)
    {
		$this->em = $entityManager;
        $this->AttachmentDAO = new AttachmentDAO($this->em);
    }

    public function addAttachment($attachment)
    {
        return $this->AttachmentDAO->addAttachment($attachment);
    }

    public function deleteAttachmentById($attachmentId){
        $attachment = $this->AttachmentDAO->getAttachmentById($attachmentId);
        return $this->AttachmentDAO->deleteAttachment($attachment);
    } 
}