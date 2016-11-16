<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValueDatetimes
 *
 * @ORM\Table(name="value_datetimes", indexes={@ORM\Index(name="fk_value_datetimes_products1_idx", columns={"product_id"}), @ORM\Index(name="fk_value_datetimes_attributes1_idx", columns={"attribute_id"})})
 * @ORM\Entity
 */
class ValueDatetimes
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="value", type="datetime", nullable=false)
     */
    private $value;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Products
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var \AppBundle\Entity\Attributes
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Attributes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="attribute_id", referencedColumnName="id")
     * })
     */
    private $attribute;



    /**
     * Set value
     *
     * @param \DateTime $value
     *
     * @return ValueDatetimes
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return \DateTime
     */
    public function getValue()
    {
        return $this->value;
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

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Products $product
     *
     * @return ValueDatetimes
     */
    public function setProduct(\AppBundle\Entity\Products $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Products
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set attribute
     *
     * @param \AppBundle\Entity\Attributes $attribute
     *
     * @return ValueDatetimes
     */
    public function setAttribute(\AppBundle\Entity\Attributes $attribute = null)
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * Get attribute
     *
     * @return \AppBundle\Entity\Attributes
     */
    public function getAttribute()
    {
        return $this->attribute;
    }
}
