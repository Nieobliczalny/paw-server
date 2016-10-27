<?php

/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-26
 * Time: 23:54
 */
namespace Example\SampleBundle\Services;


use Example\SampleBundle\DAO\BoardDAO;
use Doctrine\ORM\EntityManager;

class BoardService
{
    protected $boardDAO;
	protected $em;
    public function __construct(EntityManager $entityManager)
    {
		$this->em = $entityManager;
        $this->boardDAO = new BoardDAO($this->em);
    }
    public function getBoardById($id)
    {
        return $this->boardDAO->getBoard($id);
    }
}