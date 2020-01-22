<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
// A FAIRE : INSCRIPTION!!!!!!
//      -> Créer le UserController
//      -> Créer la route inscription
//      -> créer le Formulaire UserType (User)
//      -> Afficher le formulaire dans la vue
//      -> Récupérer les données du formulaire pour les enregistrer dans la BDD



    /**
     * @Route("/user/register", name="user_register")
     */
    public function userRegister(Request $request) {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Votre compte à bien été créer avec succès.');

            return $this->redirectToRoute('home');
        }

        return $this->render('user/post_register.html.twig', [
            'registerForm' => $form->createView(),
            'title' => 'Inscription'
        ]);
    }

    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
