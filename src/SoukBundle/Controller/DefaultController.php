<?php

namespace SoukBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->getUser();
            return $this->render(':default:index.html.twig',['user'=>$user]);
        }
        return $this->render(':default:index.html.twig');

    }

    public function indexBackAction()
    {
        return $this->render('@Souk/Default/index.html.twig');

    }
}
