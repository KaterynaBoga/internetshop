<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/product", name="product")
     */
    public function index(EntityManagerInterface $em)
    {
        $product = new Product();
        $product->setName('Notebook')->setPrice(8999.99)->setDescription('cool notebook PC');

        $em->persist($product);
        $em->flush();

        return new Response('Product created');
    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show(Product $product)
    {
        return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/products/{name}", name="products_list")
     */
    public function listProducts($name = '')
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);

        if ( $name ) {$products = $repo->findBy(['name' => $name], ['price' => 'DESC']);
        } else {
            $products = $repo->findAll();
        }

        //  $product = $repo->findOneBy(['name'=> $name]);
        //  $product = $repo->findOneByName($name);


        if (!$products) {
            throw $this->createNotFoundException('Products not found');
        }

        return $this->render('product/list.html.twig', ['products' => $products]);
    }


    /**
     * @Route("/product-update/{id}", name="product_update")
     */
    public function update(Product $product, EntityManagerInterface $em)
    {
        $product->setName('Laptop');
        $em->flush();

        return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/product-delete/{id}", name="product_delete")
     */
    public function delete(Product $product, EntityManagerInterface $em)
    {
        $em->remove($product);
        $em->flush();

        return $this->render('product/show.html.twig', ['product' => $product]);
    }
}