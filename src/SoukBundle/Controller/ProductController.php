<?php

namespace SoukBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Souk/Product/product.html.twig');
    }
}
