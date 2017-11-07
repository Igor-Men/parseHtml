<?php

namespace IK\Bundle\ParserBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;
use IK\Bundle\ParserBundle\Entity\Category;
use IK\Bundle\ParserBundle\Entity\Color;
use IK\Bundle\ParserBundle\Entity\Product;
use IK\Bundle\ParserBundle\Entity\Image;
use IK\Bundle\ParserBundle\Entity\Attribute;

class XmlParserService {

    /** @var Registry $doctrine */
    private $doctrine;

    public function __construct($doctrine) {
        $this->doctrine = $doctrine;
    }

    //первая загрузка  ( 90 минут)
    //total_count-1136 current_count-192 page-7 try-1 timeLap 1509321579-1509321618(39)(2.8833333333333min) speed-1,747.69xmlResponse-1509321579-1509321580(1) write-1509321618-1509321580(38)
    //обновление (360минут)
    //total_count-1136 current_count-192 page-7 try-1 timeLap 1509322428-1509322434(6)(0.6min) speed-11,360.00xmlResponse-1509322428-1509322428(0) write-1509322434-1509322428(6)^C


    public function writeProducts($arrayProducts) {
        $flushCnt = 0;
        foreach($arrayProducts as $keyGroup => $products) {
            $em = $this->doctrine->getManager();
            foreach ($products as $product) {
                $OriginProductId = isset($product['id']) ? $product['id'] : uniqid();
                if ($productObject = $this->doctrine->getRepository('IKBundleParserBundle:Product')->findOneBy(['oldId' => $OriginProductId])) {
                    $productObject->fillObject($product);
                } else {
                    $productObject = new Product($product);
                    $productObject->setGroupId($keyGroup);
                    if (isset($product['images']) && is_array($product['images'])) {
                        foreach ($product['images'] as $key => $image) {
                            $image = new Image($image);
                            if ($key == 0) {
                                $image->setIsMain(true);
                            } else {
                                $image->setIsMain(false);
                            }
                            $em->persist($image);
                            $productObject->addImage($image);

                        }
                    }
                    if (isset($product['colors']) && is_array($product['colors'])) {
                        foreach ($product['colors'] as $color) {
                            $color = new Color($color);
                            $em->persist($color);
                            $productObject->addColor($color);
                        }
                    }
                    if (isset($product['attributes']) && is_array($product['attributes'])) {
                        foreach ($product['attributes'] as $attribute) {
                            $attribute = new Attribute($attribute);
                            $em->persist($attribute);
                            $productObject->addAttribute($attribute);
                        }
                    }
                    if (isset($product['categories']) && is_array($product['categories'])) {
                        $ids = $product['categories'];
                        $categories = $this->doctrine->getRepository('IKBundleParserBundle:Category')->findByOldId($ids);
                        /** @var Category $category */
                        foreach ($categories as $category) {
                            $productObject->addCategory($category);
                        }
                    }
                }
                $em->persist($productObject);
                $flushCnt++;
            }
            $em->flush();
        }
        return $flushCnt;
    }

    public function writeCategoies($arrayItems, $verbose = false) {

        if (!isset($arrayItems['item']) || !is_array($arrayItems['item'])) {
            return false;
        }
        $itemsWrited = 0;
        for ($i=1; $i < 7; $i++) {
            $em = $this->doctrine->getManager();
            foreach ($arrayItems['item'] as $item) {
                if ($item['level'] == $i) {
                    $category = $this->doctrine->getRepository('IKBundleParserBundle:Category')
                        ->findOneBy(['old_id' => $item['id']]);
                    if (!$category) {
                        $newCategory = new Category();
                        $newCategory->setName($item['name']);
                        $newCategory->setSlug($item['slug']);
                        $newCategory->setPath($item['path']);
                        $newCategory->setOldId($item['id']);

                        $parentCategory = false;
                        if ($item['parent_id']) {
                            $parentCategory = $this->doctrine->getRepository('IKBundleParserBundle:Category')
                                ->findOneBy(['old_id' => $item['parent_id']]);
                        }
                        if ($parentCategory){
                            $newCategory->setParent($parentCategory);
                            $em->persist($parentCategory);
                        }
                        $em->persist($newCategory);
                        $itemsWrited++;
                    }
                }
            }
            $em->flush();
            if($verbose) {
                echo "\n level " .$i. " writed ".$itemsWrited;
            }
        }
        return $itemsWrited;
    }
    /**
     * @return String
     */
    public function getXmlCategoires($api_key){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.oasiscatalog.com/v3/categories');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_USERPWD, $api_key . ":" . '');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', ''));
        $xmlString = curl_exec($curl);
        curl_close($curl);

        return $xmlString;
    }

    public function getXmlProducts($api_key,$page=0) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.oasiscatalog.com/v3/products?format=json&expand=attributes,materials&page='.$page);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_USERPWD, $api_key . ":" . '');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', ''));
        $xmlString = curl_exec($curl);
        curl_close($curl);

        return $xmlString;
    }

    public function getJsonProducts($api_key,$page=0) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.oasiscatalog.com/v3/products?format=json&expand=attributes,materials&page='.$page);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_USERPWD, $api_key . ":" . '');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', ''));
        $jsonString = curl_exec($curl);
        curl_close($curl);

        return $jsonString;
    }

    /**
     * Convert XML to PHP array
     *
     * @param string $xmlString
     *
     * @return array
     */
    public function processConvert($xmlString)
    {
        $result = [];

        if(true === $this->isXml($xmlString))
        {
            $iterator = new \SimpleXMLIterator($xmlString);

            $result = $this->getArrayFromXml($iterator);
        }

        return $result;
    }

    /**
     * Convert XML to PHP array
     *
     * @param \SimpleXMLIterator $iterator
     *
     * @return array
     */
    protected function getArrayFromXml(\SimpleXMLIterator $iterator)
    {
        $result = [];
        $i = 0;
        for($iterator->rewind(); $iterator->valid(); $iterator->next())
        {
            if($iterator->hasChildren())
            {
                foreach($iterator->getChildren() as $key => $value)
                {
                    if(1 <= $value->count())
                    {
                        $result[$iterator->key()][$i][][$key] = $this->getArrayFromXml($value);
                    }
                    else
                    {
                        if(true === $value->hasChildren())
                        {
                            $result[$iterator->key()][$i][$key] = $this->getArrayFromXml($value);
                        }
                        else
                        {
                            $result[$iterator->key()][$i] = $this->getArrayFromXml($iterator->current());
                        }
                    }
                }
            }
            else
            {
                $result[$iterator->key()] = $this->convertToStringOrBoolean($iterator->current());
            }
            $i++;
        }

        return $result;
    }

    /**
     * Cast to string or to a boolean value if the string contains a true or false
     *
     * @param mixed $string
     *
     * @return boolean|string
     */
    protected function convertToStringOrBoolean($string)
    {
        $result = (string) $string;
        $lowerString = strtolower($result);

        if('true' === $lowerString)
        {
            $result = true;
        }
        elseif('false' === $lowerString)
        {
            $result = false;
        }

        return $result;
    }

    /**
     * Checks XML string for validity
     *
     * @param string $xmlString
     *
     * @return boolean
     */
    public function isXml($xmlString)
    {
        $previousValue = libxml_use_internal_errors(true);

        $simpleXml = simplexml_load_string($xmlString);

        libxml_use_internal_errors($previousValue);

        return false !== $simpleXml;
    }

    /**
     * Removes XML declaration
     *
     * @param string $xmlString
     *
     * @return string
     */
    public function removeAnnouncement($xmlString)
    {
        $matches = [];

        preg_match('/<?xml version="(.*)" encoding="(.*)"?>(.*)$/isuU', $xmlString, $matches);

        return isset($matches[3]) ? $matches[3] : $xmlString;
    }

    /**
     * Checks XML element for valid name
     *
     * @param string $elementName Имя элемента
     *
     * @return boolean
     */
    protected function isValidElementName($elementName)
    {
        $pattern = '/^[a-z_]+[a-z0-9\:\-\.\_]*[^:]*$/i';

        return (boolean) preg_match($pattern, $elementName);
    }

}