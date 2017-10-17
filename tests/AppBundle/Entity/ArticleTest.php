<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Faker\Factory;

class ArticleTest extends TestCase
{
    /**
     * @var Article $article
     */
    private $article;
    private $faker;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->article = new Article();
        $this->faker = Factory::create('ru_RU');
    }

    /**
     * Try to set and get name
     */
    public function testName()
    {
        $name = $this->faker->name;
        $this->article->setName($name);

        $this->assertEquals($name, $this->article->getName());
    }

    /**
     * Try to set and get description
     */
    public function testDescription()
    {
        $description = $this->faker->text;
        $this->article->setDescription($description);

        $this->assertEquals($description, $this->article->getDescription());
    }

    /**
     * Try to set and get createdAt
     */
    public function testCreatedAt()
    {
        $createdAt = new \DateTime();
        $this->article->setCreatedAt($createdAt);

        $this->assertEquals($createdAt->format('d.m.Y H:i:s'), $this->article->getCreatedAt()->format('d.m.Y H:i:s'));
    }

    /**
     * Try to set and get categoryId
     */
    public function testCategoryId()
    {
        $this->article->setCategoryId(1);

        $this->assertEquals(1, $this->article->getCategoryId());
    }

    /**
     * Try to set and get languageId
     */
    public function testLanguageId()
    {
        $this->article->setLanguageId('ru');

        $this->assertEquals('ru', $this->article->getLanguageId());
    }

    /**
     * Try to set and get isActive
     */
    public function testIsActive()
    {
        $this->article->setIsActive('Y');

        $this->assertEquals('Y', $this->article->getIsActive());
    }
}
