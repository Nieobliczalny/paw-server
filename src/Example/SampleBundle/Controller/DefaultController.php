<?php

namespace Example\SampleBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class DefaultController extends FOSRestController 
{
    public function getExampleAction()
    {
        $data = [
			'value1' => 'Test',
			'value2' => '300',
		];
		$view = $this->view($data,200);
		return $this->handleView($view);
    }
}
