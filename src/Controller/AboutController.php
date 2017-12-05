<?php
/**
 * Created by PhpStorm.
 * User: BKN1402
 * Date: 05.12.2017
 * Time: 20:03
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AboutController extends Controller
{
    /**
     * @Route("/about", name="about_show")
     *
     */
    public function show(SessionInterface $session)
    {
        $url = $this->generateUrl('category_show', [
            'slug'=>'notebooks',
            'param'=>'getparam'], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->render('about\about.html.twig', ['notebooksUrl' => $url,
            'lastCategory' => $session->get('lastVisitedCategory')
        ]);
    }

    /**
     * @Route("/to-about")
     */
    public function redirectToShow()
    {
        return $this->redirectToRoute('about_show');
    }
}