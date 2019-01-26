<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\PostRepository;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front")
     */
    public function indexAction(PostRepository $repository)
    {
        $posts = $repository->findAll();
        $params = array(
            'posts' => $posts,
            'title' => 'Accueil',
        );

        return $this->render('front/accueil.html.twig', $params);
    }
}
