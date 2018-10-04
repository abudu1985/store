<?php
namespace App\Tests\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeviceControllerTest extends WebTestCase
{
    private $hoover = [
        "color"=> "red",
        "price"=> "4500.00",
        "firm"=> "rainbow",
        "power"=>1200
    ];

    private $mobile = [
        "color"=> "white",
        "price"=> "5500.00",
        "firm"=> "apple",
        "memory"=>120,
        "ram"=>4
    ];

    private $freezer = [
        "color"=> "black",
        "price"=> "8500.00",
        "firm"=> "bosch",
        "temperature"=>"-20"
    ];

    private $entities = ["mobile", "freezer", "hoover"];

    public function testGet()
    {
        $client = static::createClient();
        $client->request('GET', '/devices', [], []);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testCreateHoover()
    {
        $client = static::createClient();
        $client->request('POST', '/hoover', [], [], [], json_encode($this->hoover));
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testCreateMobile()
    {
        $client = static::createClient();
        $client->request('POST', '/mobile', [], [], [], json_encode($this->mobile));
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testCreateFreezer()
    {
        $client = static::createClient();
        $client->request('POST', '/freezer', [], [], [], json_encode($this->freezer));
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testGetOneDevice()
    {
        $client = static::createClient();
        $client->request('GET', '/device/' . rand(2, 4));
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testGetSpecificDevices()
    {
        $randIndex = array_rand($this->entities);
        $client = static::createClient();
        $client->request('GET', '/devices/' . $this->entities[$randIndex]);
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }
}