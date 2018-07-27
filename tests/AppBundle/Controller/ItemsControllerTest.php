<?php
namespace App\Tests\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ItemsControllerTest extends WebTestCase
{
    public function testGet()
    {
        $client = static::createClient();
        $client->request('GET', '/items', array(), array());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testPost()
    {
        $client = static::createClient();

        $client->request('POST', '/item', array('name'=>'SimpleTest', 'price'=>200), array());
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertContains('Item saved!', $client->getResponse()->getContent());
    }
}