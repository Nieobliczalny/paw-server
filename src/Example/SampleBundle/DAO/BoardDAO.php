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

    public function getBoard($id)
    {
        $board = $this->entityManager->getRepository('ExampleSampleBundle:Board')->find($id);
        return $board;
    }
}