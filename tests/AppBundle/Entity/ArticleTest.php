<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Doctrine\ORM\Mapping as ORM;

class ArticleTest extends TestCase
{
    /**
     * @var Article $article
     */
    private $article;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->article = new Article();
        $this->article->setName('TEST: top article');
        $this->article->setDescription('TEST: this text for article description');
        $this->article->setCreatedAt(new \DateTime());
    }


    public function testName()
    {
        $article = new Article();
        $article->setName('TEST: name');

        $this->assertEquals('TEST: name', $article->getName());
    }
}
;