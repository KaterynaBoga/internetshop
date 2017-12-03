<?php
/**
 * Created by PhpStorm.
 * User: BKN1402
 * Date: 02.12.2017
 * Time: 17:51
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UlrichController extends Controller
{

    /**
     *@Route("/ulrich/about")
     *
     * @return Response
     */
    public function about() {
        $about = 'about';
        return $this->render('ulrich/about.html.twig', array(
            'about' => $about,
        ));
    }

}