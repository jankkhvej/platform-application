<?php

namespace Szkla\Bundle\ProductGridBundle\Migrations\Data\ORM;

use Szkla\Bundle\ProductGridBundle\Entity\Product;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Class LoadProducts
 */
class LoadProducts implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $product = new Product();
        $product->setSku('SZKL-000001-00001-01-01-ABCdef-XYZ-XYZZY-0A');
        $manager->persist($product);

        $product = new Product();
        $product->setSku('SZKL-000002-00001-01-01-ABCdef-XYZ-XYZZY-0B');
        $product->setIsActive(false);
        $manager->persist($product);

        $manager->flush();
    }
}
