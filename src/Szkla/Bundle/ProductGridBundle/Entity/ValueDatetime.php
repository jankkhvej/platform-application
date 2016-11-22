<?php

namespace Szkla\Bundle\ProductGridBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValueDatetimes
 *
 * @ORM\Table(name="value_datetimes", indexes={@ORM\Index(name="fk_value_datetimes_products1_idx", columns={"product_id"}), @ORM\Index(name="fk_value_datetimes_attributes1_idx", columns={"attribute_id"})})
 * @ORM\Entity
 */
class ValueDatetime
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
     * @var \Szkla\Bundle\ProductGridBundle\Entity\Product
     *
     * @ORM\ManyToOne(
     *     targetEntity="Szkla\Bundle\ProductGridBundle\Entity\Product",
     *     inversedBy="datetimeValues",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var \Szkla\Bundle\ProductGridBundle\Entity\Attribute
     *
     * @ORM\ManyToOne(
     *     targetEntity="Szkla\Bundle\ProductGridBundle\Entity\Attribute"
     * )
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
     * @return ValueDatetime
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
     * @param \Szkla\Bundle\ProductGridBundle\Entity\Product $product
     *
     * @return ValueDatetime
     */
    public function setProduct(\Szkla\Bundle\ProductGridBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Szkla\Bundle\ProductGridBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set attribute
     *
     * @param \Szkla\Bundle\ProductGridBundle\Entity\Attribute $attribute
     *
     * @return ValueDatetime
     */
    public function setAttribute(\Szkla\Bundle\ProductGridBundle\Entity\Attribute $attribute = null)
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * Get attribute
     *
     * @return \Szkla\Bundle\ProductGridBundle\Entity\Attribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }
}
