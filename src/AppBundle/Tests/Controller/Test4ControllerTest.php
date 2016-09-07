<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group test4
 */
class Test4ControllerTest extends WebTestCase
{

    /**
     * @dataProvider provider
     */
    public function testSuccess($n, $expected)
    {
        $client = static::createClient();

        $client->request('POST', '/test4', ['n' => $n]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $actual = json_decode($client->getResponse()->getContent());
        $this->assertEquals($expected, $actual);
    }

    public function testFailure()
    {
        $client = static::createClient();

        $client->request('POST', '/test4');
        $this->assertNotEquals(200, $client->getResponse()->getStatusCode());
        $this->assertNotEquals(500, $client->getResponse()->getStatusCode());
    }

    public function provider()
    {
        return [
            '0' => [
                0,
                [],
            ],
            '1' => [
                1,
                [0],
            ],
            '10' => [
                10,
                [0, 1, 1, 2, 3, 5, 8, 13, 21, 34],
            ],
        ];
    }
}