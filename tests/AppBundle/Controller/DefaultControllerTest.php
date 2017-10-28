<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndexAction()
    {
        $client = static::createClient();

        $crawler= $client->request('GET', '/');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("MSG")')->count()
        );
    }

    public function testAdminAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/admin', array(), array(), array('PHP_AUTH_USER' => 'test', 'PHP_AUTH_PW' => 'test'));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Admin page!")')->count()
        );
    }
}
