<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home() {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $categories = $repo->findAllCategories();


        $posts = $repo->findAll();
        return $this->render('post/index.html.twig', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/post/{id}", name="affiche_post")
     */
    public function showPost($id) {
        $manager = $this->getDoctrine()->getManager();
        $post = $manager->find(Post::class, $id);

        $repo = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repo->findBy(['idPost' => $id], ['datePosted' => 'DESC']);

        return $this->render('post/post.html.twig', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    /**
     * @Route("/category/{cat}", name="categorie")
     */
    public function showCategory($cat) {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repo->findBy(['category' => $cat]);

        $categories = $repo->findAllCategories();


        return $this->render('post/index.html.twig', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
}
