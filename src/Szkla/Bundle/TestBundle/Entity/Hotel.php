<?php
/**
 *
 */

namespace Szkla\Bundle\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Szkla\Bundle\TestBundle\Model\ExtendHotel;

/**
 * Class Hotel
 *
 * @ORM\Entity
 * @ORM\Table(
 *     name="szkla_hotel",
 *     options={
 *         "collate": "utf8mb4_general_ci",
 *         "charset": "utf8mb4",
 *         "engine": "InnoDB"
 *      }
 * )
 * @Config
 */
class Hotel extends ExtendHotel
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}
