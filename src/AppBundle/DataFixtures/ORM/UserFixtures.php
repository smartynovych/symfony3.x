<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setUsername('msg');
        $user->setEmail('admin@devmsg.info');
        $user->setPassword(password_hash('admin', PASSWORD_DEFAULT, array('cost' => 12)));
        $manager->persist($user);
        $manager->flush();
    }
}
