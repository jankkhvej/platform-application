<?php

namespace Szkla\Bundle\ProductGridBundle\Migrations\Data\ORM;

use Szkla\Bundle\ProductGridBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Class LoadUsers
 */
class LoadUsers implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $password = 't35tPassw0rD';

        $user = new User();
        $user->setIsActive(true);
        $user->setEmail('ssolianyk@szkla.pl');
        $user->setNote(sprintf('The password is "%s", without quotes.', $password));
        $user->setUsername('ssolianyk');
        $user->setPassword(password_hash($password, \PASSWORD_DEFAULT));
        $manager->persist($user);

        $manager->flush();
    }
}
