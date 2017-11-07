<?php

namespace IK\Bundle\ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Color
 *
 * @ORM\Table(name="color")
 * @ORM\Entity(repositoryClass="IK\Bundle\ParserBundle\Repository\ColorRepository")
 */
class Color
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
     * @ORM\Column(name="color", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="IK\Bundle\ParserBundle\Entity\Product", inversedBy="images" , cascade={"persist"})
     */
    private $product;

    public function __construct($dataArray = []) {
        if ($dataArray) {
            $this->fillObject($dataArray);
        }
        return $this;
    }

    protected function fillObject($dataArray) {
        $this->name = isset($dataArray['name']) ? $dataArray['name'] : null;
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
     * Set name
     *
     * @param string $name
     *
     * @return Color
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
     * Set product
     *
     * @param \IK\Bundle\ParserBundle\Entity\Product $product
     *
     * @return Color
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
