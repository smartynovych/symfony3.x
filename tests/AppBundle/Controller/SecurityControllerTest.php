<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testIndexAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/auth');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Sign in form")')->count()
        );

        // Fail token test
        $username = 'msg';
        $password = 'admin';

        $client->request('POST', '/auth', array(
            '_username' => $username,
            '_password' => $password,
            '_csrf_token' => '',
            '_target_path' => '/admin',
            ));
        $crawler = $client->followRedirect();

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Invalid CSRF token")')->count()
        );

        // Fail password test
        $username = 'msg';
        $password = 'fail password';
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
            $crawler->filter('html:contains("Invalid credentials")')->count()
        );

        // Correct credentials test
        $username = 'msg';
        $password = 'admin';
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
            $crawler->filter('html:contains("Hello, '.$username.'")')->count()
        );

        // Logout test
        $client->request('GET', '/logout');
        $crawler = $client->followRedirect();
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Exercise name")')->count()
        );
    }
}
