<?php

/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-26
 * Time: 23:51
 */
namespace Example\SampleBundle\DAO;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BoardDAO extends Controller
{
    protected $em;
    public function __construct()
    {
        $this->em = $this->getDoctrine()->getEntityManager();
    }
    public function getBoard($id)
    {
        $board = $this->em->getRepository('ExampleSampleBundle:Board')->find($id);
        return $board;
    }
}