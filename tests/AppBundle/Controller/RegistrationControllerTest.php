<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Faker\Factory;

class RegistrationControllerTest extends WebTestCase
{
    public function testIndexAction()
    {
        $client = static::createClient();

        // check signup page
        $crawler= $client->request('GET', '/signup');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Sign up form")')->count()
        );

        $faker = Factory::create();

        // Fail token test
        $username = $faker->userName;
        $email = $faker->email;
        $password = $faker->password();

        $crawler = $client->request('POST', '/signup', array(
            'user' => array(
                'username' => $username,
                'email' => $email,
                'plainPassword' => array('first' => $password, 'second' => $password),
                '_token' => '',
            ),
        ));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("The CSRF token is invalid")')->count()
        );

        // Successful registration
        $exists_username = $faker->userName;
        $exists_email = $faker->email;
        $password = $faker->password(8, 12);
        $token = $crawler->filter('input[name="user[_token]"]')->extract(array('value'));

        $client->request('POST', '/signup', array(
            'user' => array(
                'username' => $exists_username,
                'email' => $exists_email,
                'plainPassword' => array('first' => $password, 'second' => $password),
                '_token' => $token[0],
            ),
        ));

        $crawler = $client->followRedirect();

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Sign in form")')->count()
        );

        // Fail username test
        $username = '';
        $email = $faker->email;
        $password = $faker->password(8, 12);
        $crawler= $client->request('GET', '/signup');
        $token = $crawler->filter('input[name="user[_token]"]')->extract(array('value'));

        $crawler = $client->request('POST', '/signup', array(
            'user' => array(
                'username' => $username,
                'email' => $email,
                'plainPassword' => array('first' => $password, 'second' => $password),
                '_token' => $token[0],
            ),
        ));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("This value should not be blank")')->count()
        );

        // Exists username test
        $username = $exists_username;
        $email = $faker->email;
        $password = $faker->password(8, 12);
        $crawler= $client->request('GET', '/signup');
        $token = $crawler->filter('input[name="user[_token]"]')->extract(array('value'));

        $crawler = $client->request('POST', '/signup', array(
            'user' => array(
                'username' => $username,
                'email' => $email,
                'plainPassword' => array('first' => $password, 'second' => $password),
                '_token' => $token[0],
            ),
        ));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Username already taken")')->count()
        );

        // Fail email test
        $username = $faker->userName;
        $email = '';
        $password = $faker->password(8, 12);
        $crawler= $client->request('GET', '/signup');
        $token = $crawler->filter('input[name="user[_token]"]')->extract(array('value'));

        $crawler = $client->request('POST', '/signup', array(
            'user' => array(
                'username' => $username,
                'email' => $email,
                'plainPassword' => array('first' => $password, 'second' => $password),
                '_token' => $token[0],
            ),
        ));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("This value should not be blank")')->count()
        );

        // Exists email test
        $username = $faker->userName;
        $email = $exists_email;
        $password = $faker->password(8, 12);
        $crawler= $client->request('GET', '/signup');
        $token = $crawler->filter('input[name="user[_token]"]')->extract(array('value'));

        $crawler = $client->request('POST', '/signup', array(
            'user' => array(
                'username' => $username,
                'email' => $email,
                'plainPassword' => array('first' => $password, 'second' => $password),
                '_token' => $token[0],
            ),
        ));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Email already taken")')->count()
        );

        // Fail password test
        $username = $faker->userName;
        $email = $faker->email;
        $password = '';
        $crawler= $client->request('GET', '/signup');
        $token = $crawler->filter('input[name="user[_token]"]')->extract(array('value'));

        $crawler = $client->request('POST', '/signup', array(
            'user' => array(
                'username' => $username,
                'email' => $email,
                'plainPassword' => array('first' => $password, 'second' => $password),
                '_token' => $token[0],
            ),
        ));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("This value should not be blank")')->count()
        );

        // Fail password repeat test
        $username = $faker->userName;
        $email = $faker->email;
        $password = $faker->password(8, 12);
        $crawler= $client->request('GET', '/signup');
        $token = $crawler->filter('input[name="user[_token]"]')->extract(array('value'));

        $crawler = $client->request('POST', '/signup', array(
            'user' => array(
                'username' => $username,
                'email' => $email,
                'plainPassword' => array('first' => $password, 'second' => $password.$password),
                '_token' => $token[0],
            ),
        ));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("This value is not valid")')->count()
        );
    }
}
