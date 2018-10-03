<?php
namespace App\Tests\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersControllerTest extends WebTestCase
{
    public function testGet()
    {
        $client = static::createClient();
        $client->request('GET', '/users', array(), array());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testPost()
    {
        $client = static::createClient();

        $client->request('POST', '/user', array('name'=>'Sebastian Bergmann'), array());
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertContains('User saved!', $client->getResponse()->getContent());
    }
}