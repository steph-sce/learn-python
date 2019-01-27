<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction(PostRepository $repository)
    {
        $posts      = $repository->findAll();
        $categories = $repository->findAll();

        $params = array(
            'title'      => 'accueil',
            'posts'      => $posts,
            'categories' => $categories,
        );

        return $this->render('front/index.html.twig', $params);
    }

    /**
     * @Route("/video/{id}", name="video")
     */
    public function videoAction(Post $id)
    {
        $em    = $this->getDoctrine()->getManager();
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
    public function initiationAction(CategoryRepository $repository)
    {
        // Categorie Introduction
        $initiation = $repository->findBy(array('name' => 'Introduction'));
        $childrenInit = $repository->findBy(array('parent' => $initiation));

        // Categorie Les structures de données
        $structureData = $repository->findBy(array('name' => 'Les structures de données'));
        $childrenStruct = $repository->findBy(array('parent' => $structureData));

        // Categorie Les classes
        $classes = $repository->findBy(array('name' => 'Les classes'));
        $childrenClass = $repository->findBy(array('parent' => $classes));

        $params = array(
            'title'    => 'initiation',
            'initiation' => $childrenInit,
            'structure' => $childrenStruct,
            'classe' => $childrenClass
        );

        return $this->render('front/initiation.html.twig', $params);
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
