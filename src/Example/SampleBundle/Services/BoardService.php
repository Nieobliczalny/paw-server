<?php

/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-26
 * Time: 23:54
 */
namespace Example\SampleBundle\Services;

use Example\SampleBundle\DAO\BoardDAO;

class BoardService
{
    protected $boardDAO;
    public function __construct()
    {
        $this->boardDAO = new BoardDAO();
    }
    public function getBoardById($id)
    {
        return $this->boardDAO->getBoard($id);
    }
}