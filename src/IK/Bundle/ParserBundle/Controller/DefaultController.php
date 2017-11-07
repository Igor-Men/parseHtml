<?php

namespace IK\Bundle\ParserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function categoiesAction(Request $request)
    {

//        $category = $this->get('doctrine')->getRepository('IKBundleParserBundle:Category')->find(1236);
//        foreach ($category->getProducts() as $product) {
//            var_dump($product->getArticle(), $product->getOldId());
//        }
        exit('read README.md');
    }
}
