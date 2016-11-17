<?php

namespace Szkla\Bundle\ProductGridBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

/**
 * Products
 *
 * @ORM\Table(name="products", uniqueConstraints={@ORM\UniqueConstraint(name="sku_UNIQUE", columns={"sku"})}, indexes={@ORM\Index(name="is_active", columns={"is_active"})})
 * @ORM\Entity
 * @Config
 */
class Products
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime", nullable=true)
     */
    private $createTime = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modify_time", type="datetime", nullable=true)
     */
    private $modifyTime;

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=255, nullable=false)
     */
    private $sku;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default": 1})
     */
    private $isActive = true;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     *
     * @return Products
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set modifyTime
     *
     * @param \DateTime $modifyTime
     *
     * @return Products
     */
    public function setModifyTime($modifyTime)
    {
        $this->modifyTime = $modifyTime;

        return $this;
    }

    /**
     * Get modifyTime
     *
     * @return \DateTime
     */
    public function getModifyTime()
    {
        return $this->modifyTime;
    }

    /**
     * Set sku
     *
     * @param string $sku
     *
     * @return Products
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Products
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
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
