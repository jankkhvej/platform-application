<?php

namespace Szkla\Bundle\ProductGridBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attributes
 *
 * @ORM\Table(name="attributes", uniqueConstraints={@ORM\UniqueConstraint(name="attribute_name_UNIQUE", columns={"attribute_name"})}, indexes={@ORM\Index(name="attribute_type", columns={"attribute_type"}), @ORM\Index(name="is_required", columns={"is_required"})})
 * @ORM\Entity
 */
class Attributes
{
    const TYPE_INTEGER = 'integer';
    const TYPE_DECIMAL = 'decimal';
    const TYPE_DATETIME = 'datetime';
    const TYPE_VARCHAR = 'varchar';
    const TYPE_TEXT = 'text';

    static private $_types = null;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_name", type="string", length=255, nullable=false)
     */
    private $attributeName;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_type", type="string", nullable=false)
     */
    private $attributeType;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_required", type="boolean", nullable=false, options={"default": 0})
     */
    private $isRequired = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * Set attributeName
     *
     * @param string $attributeName
     *
     * @return Attributes
     */
    public function setAttributeName($attributeName)
    {
        $this->attributeName = $attributeName;

        return $this;
    }

    /**
     * Get attributeName
     *
     * @return string
     */
    public function getAttributeName()
    {
        return $this->attributeName;
    }

    /**
     * Set attributeType
     *
     * @param string $attributeType
     *
     * @return Attributes
     */
    public function setAttributeType($attributeType)
    {
        if (!in_array($attributeType, static::getAttributeTypeFieldChoices())) {
            throw new \InvalidArgumentException(
                sprintf('Invalid value for attributes.attribute_type : "%s"', var_export($attributeType, true))
            );
        }

        $this->attributeType = $attributeType;

        return $this;
    }

    /**
     * Get attributeType
     *
     * @return string
     */
    public function getAttributeType()
    {
        return $this->attributeType;
    }

    /**
     * Set isRequired
     *
     * @param boolean $isRequired
     *
     * @return Attributes
     */
    public function setIsRequired($isRequired)
    {
        $this->isRequired = $isRequired;

        return $this;
    }

    /**
     * Get isRequired
     *
     * @return boolean
     */
    public function getIsRequired()
    {
        return $this->isRequired;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    static public function getAttributeTypeFieldChoices()
    {
        // Build $_types if this is the first call
        if (null === static::$_types)
        {
            static::$_types = array ();
            $oClass = new \ReflectionClass('\Szkla\Bundle\ProductGridBundle\Entity\Attributes');
            $classConstants = $oClass->getConstants();
            $constantPrefix = "TYPE_";
            foreach ($classConstants as $key => $val)
            {
                if (substr($key, 0, strlen($constantPrefix)) === $constantPrefix)
                {
                    static::$_types[$val] = $val;
                }
            }
        }
        return static::$_types;
    }


}
