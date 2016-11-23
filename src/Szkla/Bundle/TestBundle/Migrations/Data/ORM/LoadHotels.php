<?php
/**
 *
 */

namespace Szkla\Bundle\TestBundle\Migrations\Data\ORM;

use Szkla\Bundle\TestBundle\Entity\Hotel;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadHotels implements FixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $hotel = new Hotel();
        $hotel->setName('Hotel #1');
        $manager->persist($hotel);

        $hotel = new Hotel();
        $hotel->setName('Hotel #2');
        $manager->persist($hotel);

        $manager->flush();
    }
}