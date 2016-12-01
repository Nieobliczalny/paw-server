<?php

namespace Example\SampleBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/boards/1');

		$json = json_decode($client->getResponse()->getContent());
        $this->assertEquals(1, $json->id);
		$this->assertEquals(true, true);
    }
}
