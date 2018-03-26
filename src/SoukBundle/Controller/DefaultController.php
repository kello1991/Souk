<?php

namespace SoukBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render(':default:index.html.twig');
    }

    public function indexBackAction()
    {
        return $this->render('@Souk/Default/index.html.twig');

    }
}
