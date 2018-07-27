<?php
namespace App\Tests\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrdersControllerTest extends WebTestCase
{
    public function testGet()
    {
        $client = static::createClient();
        $client->request('GET', '/orders', array(), array());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testPost()
    {
        $client = static::createClient();
        $testData = [
            "name" => "new order55",
            "user" => ["id" => 4],
            "items" => [
                ["id" => 1, "qty" => "6"],
                ["id" => 3, "qty" => "3"],
                ["id" => 2, "qty" => 2]]
        ];

        $client->request('POST', '/order', $testData, array());
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertContains('Order saved!', $client->getResponse()->getContent());
    }
}