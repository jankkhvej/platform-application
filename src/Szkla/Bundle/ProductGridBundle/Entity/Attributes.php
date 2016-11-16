<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attributes
 *
 * @ORM\Table(name="attributes", uniqueConstraints={@ORM\UniqueConstraint(name="attribute_name_UNIQUE", columns={"attribute_name"})}, indexes={@ORM\Index(name="attribute_type", columns={"attribute_type"}), @ORM\Index(name="is_required", columns={"is_required"})})
 * @ORM\Entity
 */
class Attributes
{
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
     * @ORM\Column(name="is_required", type="boolean", nullable=false)
     */
    private $isRequired = '0';

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
}
