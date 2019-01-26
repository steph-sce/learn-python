<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PostType;
use Knp\Component\Pager\PaginatorInterface;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post_show")
     */
    public function indexAction(PostRepository $repository, PaginatorInterface $paginator, Request $request)
    {
        $query = $repository->findAll(PostType::class);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );

        $params = array(
            'title' => 'initiation',
            'pagination' => $pagination
        );

        return $this->render('post/post_show.html.twig', $params);
    }

    /**
     * @Route("/post/new", name="post_create")
     * @Route("/post/{id}/edit", name="post_edit")
     */
    public function formAction(Post $post = null, Request $request, ObjectManager $manager)
    {
        if (!$post) {
           $post = new Post();
        }        

        $post->setTitle("Titre d'exemple")
             ->setContent("Le contenu de l'article");

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$post->getId()) {
                $post->setDate(new \DateTime());
            }

            $manager->persist($post);
            $manager->flush();

            return $this->redirectToRoute('video', ['id' => $post->getId()]);
        }

        return $this->render('post/create.html.twig', [
            'formPost' => $form->createView(),
            'editMode' => $post->getId() !== null
        ]);
    }

    /**
     * @Route("/post/delete/{id}/", name="post_delete")
     * Page qui supprime un post
     */
    public function postDeleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->find(Post::class, $id);

        $em->remove($post);
        $em->flush();

        $session = $request->getSession();
        $session->getFlashBag()->add("success", 'La commande ' . $id . ' a bien été supprimé!');

        return $this->redirectToRoute('post_show');
    }
}
