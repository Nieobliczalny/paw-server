<?php

/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-26
 * Time: 23:54
 */
namespace Example\SampleBundle\Services;


use Example\SampleBundle\DAO\TagDAO;
use Example\SampleBundle\Entity\Tag;
use Doctrine\ORM\EntityManager;

class TagService
{
    protected $tagDAO;
	protected $em;
    protected $boardService;
    protected $cardService;
    public function __construct(EntityManager $entityManager, BoardService $boardService, CardService $cardService)
    {
		$this->em = $entityManager;
        $this->tagDAO = new TagDAO($this->em);
        $this->boardService = $boardService;
        $this->cardService = $cardService;
    }

    public function updateTag($id, $colour, $content)
    {
        $this->tagDAO->updateTag($id, $colour, $content);
    }

    public function deleteTagById($id){
        return $this->tagDAO->deleteTag($id);
    }

    public function addTag($boardId, $colour, $content)
    {
        $tag = new Tag();
        $tag->setColour($colour);
        $tag->setContent($content);
        $tag = $this->tagDAO->addTag($tag);
        $board = $this->boardService->getBoardById($boardId);
        $board->addTag($tag);
        $this->entityManager->flush();
        return $tag;
    }

    public function addTagToCard($tagId, $cardId){
        $tag  = $this->tagDAO->getTagById($tagId);
        $card = $this->cardService->getCardById($cardId);
        $card->addTag($tag);
        $this->entityManager->flush();
        return $tag;
    }
    public function getTagsByBoard($boardId){
        return $this->boardService->getBoardById($boardId)->getTags();
    }
    public function getTagsByCard($cardId){
        return $this->cardService->getCardById($cardId)->getTags();
    }

}