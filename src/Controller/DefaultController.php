<?php
/**
 * Created by PhpStorm.
 * User: BKN1402
 * Date: 22.12.2017
 * Time: 21:15
 */

namespace App\Controller;

use App\Service\Catalogue;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends Controller

{

    /**
     * @Route("/", name="homepage")
     */
    public function index(Catalogue $catalogue)
    {
        return $this->render('default/index.html.twig', ['products' => $catalogue->getTopProducts()]);
    }

    /**
     * @Route("/to-about")
     */
    public function redirectToShow()
    {
        return $this->redirectToRoute('isTop');
    }

}

