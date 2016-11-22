<?php

namespace Szkla\Bundle\ProductGridBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValueVarchars
 *
 * @ORM\Table(name="value_varchars", indexes={@ORM\Index(name="fk_value_varchars_products_idx", columns={"product_id"}), @ORM\Index(name="fk_value_varchars_attributes1_idx", columns={"attribute_id"})})
 * @ORM\Entity
 */
class ValueVarchar
{
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
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
     * @ORM\ManyToOne(targetEntity="Szkla\Bundle\ProductGridBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var \Szkla\Bundle\ProductGridBundle\Entity\Attribute
     *
     * @ORM\ManyToOne(targetEntity="Szkla\Bundle\ProductGridBundle\Entity\Attribute")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="attribute_id", referencedColumnName="id")
     * })
     */
    private $attribute;



    /**
     * Set value
     *
     * @param string $value
     *
     * @return ValueVarchar
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
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
     * @return ValueVarchar
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
     * @return ValueVarchar
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
