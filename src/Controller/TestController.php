<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
//    /**
//     * @Route("/test", name="test")
//     */
//    public function index()
//    {
//        return $this->render('test/index.html.twig', [
//            'controller_name' => 'TestController',
//        ]);
//    }

    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil()
    {
        echo 'Hello world!';
    }

    /**
     * @Route("/bonjour", name="bonjour")
     */
    public function bonjour()
    {
        return new Response("Bonjour!");
    }

    /**
     * @Route("/hola/{name}")
     */
    public function hola($name) {
        return $this->render("test/hola.html.twig", [
            'name' => $name,
        ]);
    }

    /**
     * @Route("/redirect")
     */
    public function redirection() {
        return $this->redirectToRoute('bonjour');
    }

    /**
     * @Route("/message", name="message")
     */
    public function message() {
        $this->addFlash('success', "Félicitations, vous êtes inscrit!");
        $this->addFlash('failure', "Lw'article 2 à bien été supprimé.");

        return $this->render('test/message.html.twig');
    }
}