<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/post", name="admin_post")
     */
    public function adminPost() {
        $repo = $this->getDoctrine()->getRepository(Post::class);

        $posts = $repo->findAll();
        return $this->render('admin/post_list.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/admin/post/add", name="admin_post_add")
     */
    public function adminPostAdd(Request $request) {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

        $manager = $this->getDoctrine()->getManager();
        $post->setDatePosted(new \DateTime('now'));
        $manager->persist($post);
        $manager->flush();

        $this->addFlash('success', 'Le post nb' . $post->getId() . ' à été ajouté.');

        return $this->redirectToRoute('home');
        }

        return $this->render('admin/post_form.html.twig', [
            'postForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/post/delete/{id}", name="admin_post_delete")
     */
    public function adminPostDelete($id) {

    }
}
