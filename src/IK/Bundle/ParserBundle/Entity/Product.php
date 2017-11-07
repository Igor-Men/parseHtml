<?php

namespace IK\Bundle\ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="IK\Bundle\ParserBundle\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="article", type="string", length=255, nullable=true)
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255, nullable=true)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=255, nullable=true)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="discount_price", type="string", length=255, nullable=true)
     */
    private $discountPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255, nullable=true)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="group_id", type="string", length=255, nullable=true)
     */
    private $group_id;

    /**
     * @var string
     *
     * @ORM\Column(name="branding", type="string", length=255, nullable=true)
     */
    private $branding;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="material", type="string", length=500, nullable=true)
     */
    private $material;

    /**
     * @var int
     *
     * @ORM\Column(name="old_id", type="string", nullable=true)
     */
    private $oldId;

    /**
     * @ORM\OneToMany(targetEntity="IK\Bundle\ParserBundle\Entity\Image", mappedBy="product", cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="IK\Bundle\ParserBundle\Entity\Color", mappedBy="product", cascade={"persist"})
     */
    private $colors;

    /**
     * @ORM\OneToMany(targetEntity="IK\Bundle\ParserBundle\Entity\Attribute", mappedBy="product", cascade={"persist"})
     */
    private $attributes;

    /**
     * @ORM\ManyToMany(targetEntity="IK\Bundle\ParserBundle\Entity\Category" , inversedBy="products", cascade={"persist"})
     */
    private $categories;

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
     * Set article
     *
     * @param string $article
     *
     * @return Product
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return string
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * Set fullName
     *
     * @param string $fullName
     *
     * @return Product
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set size
     *
     * @param string $size
     *
     * @return Product
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set discountPrice
     *
     * @param string $discountPrice
     *
     * @return Product
     */
    public function setDiscountPrice($discountPrice)
    {
        $this->discountPrice = $discountPrice;

        return $this;
    }

    /**
     * Get discountPrice
     *
     * @return string
     */
    public function getDiscountPrice()
    {
        return $this->discountPrice;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set branding
     *
     * @param string $branding
     *
     * @return Product
     */
    public function setBranding($branding)
    {
        $this->branding = $branding;

        return $this;
    }

    /**
     * Get branding
     *
     * @return string
     */
    public function getBranding()
    {
        return $this->branding;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set material
     *
     * @param string $material
     *
     * @return Product
     */
    public function setMaterial($material)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return string
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set oldId
     *
     * @param integer $oldId
     *
     * @return Product
     */
    public function setOldId($oldId)
    {
        $this->oldId = $oldId;

        return $this;
    }

    /**
     * Get oldId
     *
     * @return int
     */
    public function getOldId()
    {
        return $this->oldId;
    }
    /**
     * Constructor
     */
    public function __construct($dataArray = [])
    {
        if ($dataArray) {
            $this->fillObject($dataArray);
        }
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->colors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attributes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        return $this;
    }

    public function fillObject($dataArray) {

        $this->oldId = isset($dataArray['id']) ? $dataArray['id'] : null;
        $this->article = isset($dataArray['article']) ? $dataArray['article'] : null;
        $this->name = isset($dataArray['name']) ? $dataArray['name'] : null;
        $this->fullName = isset($dataArray['full_name']) ? $dataArray['full_name'] : null;
        $this->size = isset($dataArray['size']) ? $dataArray['size'] : null;
        $this->price = isset($dataArray['price']) ? $dataArray['price'] : null;
        $this->discountPrice = isset($dataArray['discount_price']) ? $dataArray['discount_price'] : null;

        $this->brand = isset($dataArray['brand']) ? $dataArray['brand'] : null;
        $this->description = isset($dataArray['description']) ? $dataArray['description'] : null;

        $materialString = '';
        if (isset($dataArray['materials']) && is_array($dataArray['materials'])) {

            foreach ($dataArray['materials'] as $material) {
                $materialString = $materialString.$material.';';
            }
        }
        $this->material = $materialString;
    }

    /**
     * Add image
     *
     * @param \IK\Bundle\ParserBundle\Entity\Image $image
     *
     * @return Product
     */
    public function addImage(\IK\Bundle\ParserBundle\Entity\Image $image)
    {
        $this->images[] = $image;
        $image->setProduct($this);
        return $this;
    }

    /**
     * Remove image
     *
     * @param \IK\Bundle\ParserBundle\Entity\Image $image
     */
    public function removeImage(\IK\Bundle\ParserBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add color
     *
     * @param \IK\Bundle\ParserBundle\Entity\Color $color
     *
     * @return Product
     */
    public function addColor(\IK\Bundle\ParserBundle\Entity\Color $color)
    {
        $this->colors[] = $color;
        $color->setProduct($this);
        return $this;
    }

    /**
     * Remove color
     *
     * @param \IK\Bundle\ParserBundle\Entity\Color $color
     */
    public function removeColor(\IK\Bundle\ParserBundle\Entity\Color $color)
    {
        $this->colors->removeElement($color);
    }

    /**
     * Get colors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * Add attribute
     *
     * @param \IK\Bundle\ParserBundle\Entity\Attribute $attribute
     *
     * @return Product
     */
    public function addAttribute(\IK\Bundle\ParserBundle\Entity\Attribute $attribute)
    {
        $this->attributes[] = $attribute;
        $attribute->setProduct($this);
        return $this;
    }

    /**
     * Remove attribute
     *
     * @param \IK\Bundle\ParserBundle\Entity\Attribute $attribute
     */
    public function removeAttribute(\IK\Bundle\ParserBundle\Entity\Attribute $attribute)
    {
        $this->attributes->removeElement($attribute);
    }

    /**
     * Get attributes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Add category
     *
     * @param \IK\Bundle\ParserBundle\Entity\Category $category
     *
     * @return Product
     */
    public function addCategory(\IK\Bundle\ParserBundle\Entity\Category $category)
    {
        $this->categories[] = $category;
        return $this;
    }

    /**
     * Remove category
     *
     * @param \IK\Bundle\ParserBundle\Entity\Category $category
     */
    public function removeCategory(\IK\Bundle\ParserBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set groupId
     *
     * @param string $groupId
     *
     * @return Product
     */
    public function setGroupId($groupId)
    {
        $this->group_id = $groupId;

        return $this;
    }

    /**
     * Get groupId
     *
     * @return string
     */
    public function getGroupId()
    {
        return $this->group_id;
    }
}
