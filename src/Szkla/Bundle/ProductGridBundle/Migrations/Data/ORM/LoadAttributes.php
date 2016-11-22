<?php

namespace Szkla\Bundle\ProductGridBundle\Migrations\Data\ORM;

use Szkla\Bundle\ProductGridBundle\Entity\Attribute;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Class LoadAttributes
 */
class LoadAttributes implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $types = Attribute::getAttributeTypeFieldChoices();
        $i = 1;
        foreach ($types as $type_key => $type_value) {
            $attribute = new Attribute();
            $attribute->setAttributeName(sprintf('%02d_attribute_%s', $i++, $type_value));
            $attribute->setIsRequired(true);
            $attribute->setAttributeType($type_value);
            $manager->persist($attribute);
        }

        $manager->flush();
    }
}
