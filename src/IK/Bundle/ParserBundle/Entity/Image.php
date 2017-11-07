<?php

namespace IK\Bundle\ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="IK\Bundle\ParserBundle\Repository\ImageRepository")
 */
class Image
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
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $superbig;

    /**
     *
     * @ORM\Column(name="is_main", type="boolean", nullable=true)
     */
    private $isMain;

    /**
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;

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
        $this->superbig = isset($dataArray['superbig']) ? $dataArray['superbig'] : null;
        $this->isActive = true;
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
     * Set superbig
     *
     * @param string $superbig
     *
     * @return Image
     */
    public function setSuperbig($superbig)
    {
        $this->superbig = $superbig;

        return $this;
    }

    /**
     * Get superbig
     *
     * @return string
     */
    public function getSuperbig()
    {
        return $this->superbig;
    }

    /**
     * Set product
     *
     * @param \IK\Bundle\ParserBundle\Entity\Product $product
     *
     * @return Image
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

    /**
     * @return mixed
     */
    public function getIsMain() {
        return $this->isMain;
    }

    /**
     * @param mixed $isMain
     */
    public function setIsMain($isMain) {
        $this->isMain = $isMain;
    }

    /**
     * @return mixed
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }
}
