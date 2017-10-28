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

        $username = 'msg';

        $crawler = $client->request('GET', '/admin', array(), array(), array('PHP_AUTH_USER' => 'msg', 'PHP_AUTH_PW' => 'admin'));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Hello, '.$username.'")')->count()
        );
    }
}
