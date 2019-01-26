<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction(PostRepository $repository)
    {
        $posts = $repository->findAll();
        $categories = $repository->findAll();

        $params = array(
            'title' => 'accueil',
            'posts' => $posts,
            'categories' => $categories,
        );

        return $this->render('front/index.html.twig', $params);
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        return $this->render('front/login.html.twig', [
            'title' => 'login',
        ]);
    }

    /**
     * @Route("/inscription/", name="registration")
     */
    public function registrationAction()
    {
        $params = array(
            'title' => 'inscription',
        );

        return $this->render('front/inscription.html.twig', $params);
    }

    /**
     * @Route("/video/{id}", name="video")
     */
    public function videoAction(Post $id)
    {
        $em = $this->getDoctrine()->getManager();
        $video = $em->find(Post::class, $id);

        $params = array(
            'title' => 'accueil',
            'video' => $video,
        );

        return $this->render('front/video.html.twig', $params);
    }

    /**
     * @Route("/initiation/", name="initiation")
     */
    public function initiationAction()
    {
        // $posts = $repository->findAll();

        // $params = array(
        //     'title' => 'initiation',
        //     'posts' => $posts
        // );

        // return $this->render('front/initiation.html.twig', $params);
        return $this->render('front/initiation.html.twig');
    }

    /**
     * @Route("/perfectionnement/", name="improvement")
     */
    public function improvementAction()
    {
        // $posts = $repository->findAll();

        // $params = array(
        //     'title' => 'perfectionnement',
        //     'posts' => $posts
        // );

        // return $this->render('front/improvement.html.twig', $params);
        return $this->render('front/improvement.html.twig');
    }

    // /**
    //  * @Route("/resultats/", name="search_results")
    //  * @Template("@learn-python/App/templates/base.html.twig")
    //  */
    // public function searchAction(Request $request)
    // {
    //     $em = $this->getDoctrine()->getManager();
 
    //     $form = $request->query->all('form');
    //     $search = $form['search'];
        
    //     $resultats = $em->getRepository(Post::class)->find($search);
    //     // Ici on utilise une requête créée dans le GeneralRepository
 
    //     return ['search' => $search, 'resultats' => $resultats];
    // }
}
