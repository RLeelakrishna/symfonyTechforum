<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Usertype;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function index(Request $request,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }
        $em = $this->getDoctrine()->getManager();
        $user = new User();

        $form = $this->createForm(Usertype::class ,$user);

        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('photo')->getData();
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move(
                $uploads_directory,
                $filename
            );
            $user->setPhoto($filename);
            $user->setPassword($passwordEncoder->encodePassword($user,$user->getPassword()));

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_login');

            }


        return $this->render('register/register.html.twig', [
            'form' => $form->createView()

        ]);
    }
}
