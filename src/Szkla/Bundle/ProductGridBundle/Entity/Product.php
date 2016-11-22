<?php

namespace Szkla\Bundle\ProductGridBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Szkla\Bundle\ProductGridBundle\Model\ExtendProduct;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Product
 *
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 *
 * @ORM\Table(
 *     name="products",
 *     uniqueConstraints = {
 *         @ORM\UniqueConstraint(name="sku_UNIQUE", columns={"sku"})
 *     },
 *     indexes={
 *         @ORM\Index(name="is_active", columns={"is_active"})
 *     }
 * )
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity
 * @Config
 */
class Product extends ExtendProduct
{
    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="create_time", type="datetime", nullable=true)
     */
    private $createTime;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
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
     * @var Collection|ValueInteger[]
     *
     * @ORM\OneToMany(
     *     targetEntity="Szkla\Bundle\ProductGridBundle\Entity\ValueInteger",
     *     mappedBy="product",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EAGER"
     * )
     */
    private $integerValues;

    /**
     * @var Collection|ValueDecimal[]
     *
     * @ORM\OneToMany(
     *     targetEntity="Szkla\Bundle\ProductGridBundle\Entity\ValueDecimal",
     *     mappedBy="product",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EAGER"
     * )
     */
    private $decimalValues;

    /**
     * @var Collection|ValueDatetime[]
     *
     * @ORM\OneToMany(
     *     targetEntity="Szkla\Bundle\ProductGridBundle\Entity\ValueDatetime",
     *     mappedBy="product",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EAGER"
     * )
     */
    private $datetimeValues;

    /**
     * @var Collection|ValueVarchar[]
     *
     * @ORM\OneToMany(
     *     targetEntity="Szkla\Bundle\ProductGridBundle\Entity\ValueVarchar",
     *     mappedBy="product",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EAGER"
     * )
     */
    private $varcharValues;

    /**
     * @var Collection|ValueText[]
     *
     * @ORM\OneToMany(
     *     targetEntity="Szkla\Bundle\ProductGridBundle\Entity\ValueText",
     *     mappedBy="product",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EAGER"
     * )
     */
    private $textValues;


    public function __construct()
    {
        $this->integerValues = new ArrayCollection();
        $this->decimalValues = new ArrayCollection();
        $this->datetimeValues = new ArrayCollection();
        $this->varcharValues = new ArrayCollection();
        $this->textValues = new ArrayCollection();
    }


    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     *
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
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

    /**
     * Pre persist event listener
     *
     * @ORM\PrePersist
     */
    public function beforeSave()
    {
        $this->createTime = $this->modifyTime = new \DateTime('now', new \DateTimeZone('UTC'));
//        $this->modifyTime = new \DateTime('now', new \DateTimeZone('UTC'));
    }

    /**
     * Invoked before the entity is updated.
     *
     * @ORM\PreUpdate
     *
     * @param PreUpdateEventArgs $event
     */
    public function preUpdate(PreUpdateEventArgs $event)
    {
        $excludedFields = [
//            'lastLogin', 'loginCount'
        ];

        if (array_diff_key($event->getEntityChangeSet(), array_flip($excludedFields))) {
            $this->modifyTime = new \DateTime('now', new \DateTimeZone('UTC'));
        }
    }

    /**
     * @return Collection|ValueText[]
     */
    public function getTextValues()
    {
        return $this->textValues;
    }

    /**
     * Set text values
     *
     * @param Collection|ValueText[] $textValues
     *
     * @return Product
     */
    public function setTextValues(Collection $textValues)
    {
        $this->textValues = $textValues;

        return $this;
    }

    /**
     * Add text value
     *
     * @param ValueText $textValue
     *
     * @return Product
     */
    public function addTextValue(ValueText $textValue)
    {
        if (!$this->textValues->contains($textValue)) {
            $textValue->setProduct($this);
            $this->textValues->add($textValue);
        }

        return $this;
    }

    /**
     * Remove text value
     *
     * @param ValueText $textValue
     *
     * @return Product
     */
    public function removeTextValue(ValueText $textValue)
    {
        if ($this->textValues->contains($textValue)) {
            $this->textValues->removeElement($textValue);
        }

        return $this;
    }

    /**
     * @return Collection|ValueVarchar[]
     */
    public function getVarcharValues()
    {
        return $this->varcharValues;
    }

    /**
     * Set varchar values
     *
     * @param Collection|ValueVarchar[] $varcharValues
     *
     * @return Product
     */
    public function setVarcharValues(Collection $varcharValues)
    {
        $this->varcharValues = $varcharValues;

        return $this;
    }

    /**
     * Add varchar value
     *
     * @param ValueVarchar $varcharValue
     *
     * @return Product
     */
    public function addVarcharValue(ValueVarchar $varcharValue)
    {
        if (!$this->varcharValues->contains($varcharValue)) {
            $varcharValue->setProduct($this);
            $this->varcharValues->add($varcharValue);
        }

        return $this;
    }

    /**
     * Remove varchar value
     *
     * @param ValueVarchar $varcharValue
     *
     * @return Product
     */
    public function removeVarcharValue(ValueVarchar $varcharValue)
    {
        if ($this->varcharValues->contains($varcharValue)) {
            $this->varcharValues->removeElement($varcharValue);
        }

        return $this;
    }

    /**
     * @return Collection|ValueDatetime[]
     */
    public function getDatetimeValues()
    {
        return $this->datetimeValues;
    }

    /**
     * Set datetime values
     *
     * @param Collection|ValueDatetime[] $datetimeValues
     *
     * @return Product
     */
    public function setDatetimeValues(Collection $datetimeValues)
    {
        $this->datetimeValues = $datetimeValues;

        return $this;
    }

    /**
     * Add datetime value
     *
     * @param ValueDatetime $datetimeValue
     *
     * @return Product
     */
    public function addDatetimeValue(ValueDatetime $datetimeValue)
    {
        if (!$this->datetimeValues->contains($datetimeValue)) {
            $datetimeValue->setProduct($this);
            $this->datetimeValues->add($datetimeValue);
        }

        return $this;
    }

    /**
     * Remove datetime value
     *
     * @param ValueDatetime $datetimeValue
     *
     * @return Product
     */
    public function removeDatetimeValue(ValueDatetime $datetimeValue)
    {
        if ($this->datetimeValues->contains($datetimeValue)) {
            $this->datetimeValues->removeElement($datetimeValue);
        }

        return $this;
    }

    /**
     * @return Collection|ValueDecimal[]
     */
    public function getDecimalValues()
    {
        return $this->decimalValues;
    }

    /**
     * Set decimal values
     *
     * @param Collection|ValueDecimal[] $decimalValues
     *
     * @return Product
     */
    public function setDecimalValues(Collection $decimalValues)
    {
        $this->decimalValues = $decimalValues;

        return $this;
    }

    /**
     * Add decimal value
     *
     * @param ValueDecimal $decimalValue
     *
     * @return Product
     */
    public function addDecimalValue(ValueDecimal $decimalValue)
    {
        if (!$this->decimalValues->contains($decimalValue)) {
            $decimalValue->setProduct($this);
            $this->decimalValues->add($decimalValue);
        }

        return $this;
    }

    /**
     * Remove decimal value
     *
     * @param ValueDecimal $decimalValue
     *
     * @return Product
     */
    public function removeDecimalValue(ValueDecimal $decimalValue)
    {
        if ($this->decimalValues->contains($decimalValue)) {
            $this->decimalValues->removeElement($decimalValue);
        }

        return $this;
    }

    /**
     * @return Collection|ValueInteger[]
     */
    public function getIntegerValues()
    {
        return $this->integerValues;
    }

    /**
     * Set integer values
     *
     * @param Collection|ValueInteger[] $integerValues
     *
     * @return Product
     */
    public function setIntegerValues(Collection $integerValues)
    {
        $this->integerValues = $integerValues;

        return $this;
    }

    /**
     * Add integer value
     *
     * @param ValueInteger $integerValue
     *
     * @return Product
     */
    public function addIntegerValue(ValueInteger $integerValue)
    {
        if (!$this->integerValues->contains($integerValue)) {
            $integerValue->setProduct($this);
            $this->integerValues->add($integerValue);
        }

        return $this;
    }

    /**
     * Remove integer value
     *
     * @param ValueInteger $integerValue
     *
     * @return Product
     */
    public function removeIntegerValue(ValueInteger $integerValue)
    {
        if ($this->integerValues->contains($integerValue)) {
            $this->integerValues->removeElement($integerValue);
        }

        return $this;
    }

}
