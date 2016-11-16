<?php

namespace Szkla\Bundle\ProductGridBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValueIntegers
 *
 * @ORM\Table(name="value_integers", indexes={@ORM\Index(name="fk_value_integers_products1_idx", columns={"product_id"}), @ORM\Index(name="fk_value_integers_attributes1_idx", columns={"attribute_id"})})
 * @ORM\Entity
 */
class ValueIntegers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="value", type="integer", nullable=false)
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
     * @var \Szkla\Bundle\ProductGridBundle\Entity\Products
     *
     * @ORM\ManyToOne(targetEntity="Szkla\Bundle\ProductGridBundle\Entity\Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var \Szkla\Bundle\ProductGridBundle\Entity\Attributes
     *
     * @ORM\ManyToOne(targetEntity="Szkla\Bundle\ProductGridBundle\Entity\Attributes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="attribute_id", referencedColumnName="id")
     * })
     */
    private $attribute;



    /**
     * Set value
     *
     * @param integer $value
     *
     * @return ValueIntegers
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
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
     * @param \Szkla\Bundle\ProductGridBundle\Entity\Products $product
     *
     * @return ValueIntegers
     */
    public function setProduct(\Szkla\Bundle\ProductGridBundle\Entity\Products $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Szkla\Bundle\ProductGridBundle\Entity\Products
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set attribute
     *
     * @param \Szkla\Bundle\ProductGridBundle\Entity\Attributes $attribute
     *
     * @return ValueIntegers
     */
    public function setAttribute(\Szkla\Bundle\ProductGridBundle\Entity\Attributes $attribute = null)
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * Get attribute
     *
     * @return \Szkla\Bundle\ProductGridBundle\Entity\Attributes
     */
    public function getAttribute()
    {
        return $this->attribute;
    }
}
