<?php

namespace IK\Bundle\ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attribute
 *
 * @ORM\Table(name="attribute")
 * @ORM\Entity(repositoryClass="IK\Bundle\ParserBundle\Repository\AttributeRepository")
 */
class Attribute
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="dim", type="string", length=255, nullable=true)
     */
    private $dim;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="IK\Bundle\ParserBundle\Entity\Product", inversedBy="attributes" , cascade={"persist"})
     */
    private $product;

    public function __construct($dataArray = []) {
        if ($dataArray) {
            $this->fillObject($dataArray);
        }
        return $this;
    }

    protected function fillObject($dataArray) {
        $this->dim = isset($dataArray['dim']) ? $dataArray['dim'] : null;
        $this->name = isset($dataArray['name']) ? $dataArray['name'] : null;
        $this->value = isset($dataArray['value']) ? $dataArray['value'] : null;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dim
     *
     * @param string $dim
     *
     * @return Attribute
     */
    public function setDim($dim)
    {
        $this->dim = $dim;

        return $this;
    }

    /**
     * Get dim
     *
     * @return string
     */
    public function getDim()
    {
        return $this->dim;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Attribute
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Attribute
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
     * Set product
     *
     * @param \IK\Bundle\ParserBundle\Entity\Product $product
     *
     * @return Attribute
     */
    public function setProduct(\IK\Bundle\ParserBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \IK\Bundle\ParserBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
