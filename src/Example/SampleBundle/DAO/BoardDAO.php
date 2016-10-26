<?php

/**
 * Created by PhpStorm.
 * User: AdamK
 * Date: 2016-10-26
 * Time: 23:51
 */
namespace Example\SampleBundle\DAO;
class BoardDAO
{
    public function getBoard($id)
    {
        $board = $this->getDoctrine()->getRepository('ExampleSampleBundle:Board')->find($id);
        return $board;
    }
}