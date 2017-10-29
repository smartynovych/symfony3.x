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
}
