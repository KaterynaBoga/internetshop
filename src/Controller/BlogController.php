<?php
// src/Controller/BlogController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog_list")
     */
    public function listBlog()
    {
        return $this->render('blog/list.html.twig');
    }



}