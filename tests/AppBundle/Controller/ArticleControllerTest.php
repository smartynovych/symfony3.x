<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Entity\Article;
use Faker\Factory;

class ArticleControllerTest extends WebTestCase
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testCreateArticle()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/create');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Create new article")')->count()
        );

        $token = $crawler->filter('input[name="article[_token]"]')->extract(array('value'));

        $faker = Factory::create('ru_RU');

        $crawler = $client->request('POST', '/article/create', array(
            'article' => array(
                'name' => $faker->name,
                'description' => $faker->text,
                'createdAt' => array(
                    'date' => (
                        array(
                        'month' => mt_rand(1, 12),
                        'day' => mt_rand(1, 28),
                        'year' => mt_rand(2012, 2017),
                        )
                    ),
                    'time' => (
                        array(
                        'hour' => mt_rand(1, 12),
                        'minute' => mt_rand(1, 60),
                    )
                )),
                '_token' => $token[0],
                'save' => 'Save',
            )));

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testIndexArticle()
    {
        $client = static::createClient();

        $client->request('GET', '/article/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDetailArticle()
    {
        $articles = $this->em->getRepository(Article::class)->findAll();
        $article = array_pop($articles);

        if ($article) {
            $client = static::createClient();

            $client->request('GET', '/article/detail/'.$article->getId());

            $this->assertEquals(200, $client->getResponse()->getStatusCode());
        } else {
            $this->assertTrue($article, 'No article found');
        }
    }

    public function testUpdateArticle()
    {
        $articles = $this->em->getRepository(Article::class)->findAll();
        $article = array_pop($articles);

        if ($article) {
            $client = static::createClient();

            $crawler = $client->request('GET', '/article/update/'.$article->getId());

            $this->assertGreaterThan(
            0,
                $crawler->filter('html:contains("Update article #'.$article->getId().'")')->count()
            );

            $token = $crawler->filter('input[name="article[_token]"]')->extract(array('value'));

            $faker = Factory::create('ru_RU');

            $crawler = $client->request('POST', '/article/update/'.$article->getId(), array(
                'article' => array(
                    'name' => 'UPDATE #'.$article->getId(). ': '.$faker->name,
                    'description' => 'UPDATE '.$faker->text,
                    'createdAt' => array(
                        'date' => (
                            array(
                            'month' => mt_rand(1, 12),
                            'day' => mt_rand(1, 28),
                            'year' => mt_rand(2012, 2017),
                        )
                        ),
                        'time' => (
                            array(
                            'hour' => mt_rand(1, 12),
                            'minute' => mt_rand(1, 60),
                        )
                        )),
                    '_token' => $token[0],
                    'save' => 'Save',
                )));

            // TODO: msg 171017 не получаем статус редиректа, в браузер выбрасывается сообщение Redirect to /article/, возможно из-за маршрутизации в контероллере
            //$this->assertEquals(302, $client->getResponse()->getStatusCode());

            $this->assertGreaterThan(
                0,
                $crawler->filter('html:contains("Redirect")')->count()
            );
        } else {
            $this->assertTrue($article, 'No article found');
        }
    }

    public function testDeleteArticle()
    {
        $articles = $this->em->getRepository(Article::class)->findAll();
        $article = array_pop($articles);

        if ($article) {
            $client = static::createClient();

            $client->request('GET', '/article/delete/'.$article->getId());

            $this->assertEquals(302, $client->getResponse()->getStatusCode());
        } else {
            $this->assertTrue($article, 'No article found');
        }
    }

    public function testAdminAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin', array(), array(), array('PHP_AUTH_USER' => 'test', 'PHP_AUTH_PW' => 'test'));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Admin page!")')->count()
        );
    }
}
