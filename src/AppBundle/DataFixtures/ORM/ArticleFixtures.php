<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('ru_RU');

        for ($i = 0; $i < 20; $i++) {
            $article = new Article();
            $article->setName($faker->name);
            $article->setDescription($faker->text);
            $article->setCreatedAt($faker->dateTime());
            $manager->persist($article);
        }

        $manager->flush();
    }
}
