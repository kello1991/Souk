<?php

namespace SoukBundle\Controller;

use SoukBundle\Entity\Ligne;
use SoukBundle\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('SoukBundle:Article')->findAll();
        $categories = $em->getRepository('SoukBundle:Categorie')->findAll();

        return $this->render('@Souk/Product/product.html.twig',array('articles'=>$articles,'categories'=>$categories));
    }

    public function addToPanierAction(Request  $request)
    {
        try{
        $em = $this->getDoctrine()->getManager();
        $ligne= new Ligne();
        $article=$em->getRepository('SoukBundle:Article')->findOneBy(['nom'=>$request->request->get('product')]);
        $ligne->setArticle($article);
        if($request->request->get('panier')){

            $panier=$em->getRepository('SoukBundle:Panier')->find($request->request->get('panier'));
            $panier->addUserRecipeAssociation($ligne);
            $em->persist($panier);
            $em->flush();
            $serializedEntity = $this->container->get('jms_serializer')->serialize($panier, 'json');
            return new Response($serializedEntity);
        }else{

            $panier= new Panier();
            $em->persist($panier);
            $em->flush();
            $panier->addUserRecipeAssociation($ligne);
            $em->persist($panier);
            $em->flush();

            $ligne->setPanier($panier);
            $em->persist($ligne);
            $em->flush();

            $serializedEntity = $this->container->get('jms_serializer')->serialize($panier, 'json');
            return new Response($serializedEntity);

        }
        }catch (\Exception  $e){

            return new JsonResponse($e->getMessage());
        }

    }
}
