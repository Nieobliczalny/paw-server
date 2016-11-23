<?php

namespace Example\SampleBundle\Services;


use Example\SampleBundle\DAO\EntryDAO;
use Example\SampleBundle\Entity\Entry;
use Doctrine\ORM\EntityManager;

class EntryService
{
    protected $entryDAO;
	protected $em;
    
    public function __construct(EntityManager $entityManager, BoardService $boardService)
    {
		$this->em = $entityManager;
        $this->entryDAO = new EntryDAO($this->em);
        $this->boardService = $boardService;
        
    }

    public function addEntry($content, $boardId)
    {        
        $entry = new Entry();
        $entry->setContent($content); 
        $board = $this->boardService->getBoardById($boardId);
        $entry->setBoard($board);
        $time = new \DateTime();
        $time->format('H:i:s \O\n d.m.Y'); 
        $entry->setReportDate($time);        
        return $this->entryDAO->addEntry($entry);
    }
    
}