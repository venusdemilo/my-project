<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
      $em = $this->getDoctrine()->getManager();
      $product = new Product;
      $product->setName('clavier');
      $product->setPrice(199);
      $product->setDescription('Ergonomique et stylé !');

      $em->persist($product);
      $em->flush();
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'product_id' => $product->getId(),
        ]);
    }
}
