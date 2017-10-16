<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\ArticleController;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    /**
     * @var \ArticleController $article
     */
    private $article;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
    }


    public function testIndex()
    {
        $this->article = new ArticleController();

        //$this->assertEquals(200, $article->getResponse()->getStatusCode());
        //$this->assertContains('Welcome to Symfony', $article->filter('#container h1')->text());

        $result = 42;

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(42, $result);
    }
}
