<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testIndexAction()
    {
        $client = static::createClient();

        $client->request('GET', '/admin');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        // Correct credentials test
        $username = 'msg';
        $password = 'admin';
        $crawler = $client->request('GET', '/auth');
        $token = $crawler->filter('input[name="_csrf_token"]')->extract(array('value'));

        $client->request('POST', '/auth', array(
            '_username' => $username,
            '_password' => $password,
            '_csrf_token' => $token[0],
            '_target_path' => '/admin',
            ));
        $crawler = $client->followRedirect();

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Sign out")')->count()
        );
    }
}
