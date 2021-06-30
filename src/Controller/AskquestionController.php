<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\Ask;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @IsGranted("ROLE_USER")
 */
class AskquestionController extends AbstractController
{
    /**
     * @Route("/ask", name="ask_question")
     */
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $ask = new Question();
        $ask->setCreatedAt(new \DateTime());
        $ask->setUpdatedAt(new \DateTime());
        $ask->setUser($this->getUser());

        $form = $this->createForm(Ask::class , $ask);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($ask);
            $em->flush();

            return $this->redirectToRoute('app_Qlist');
        }




        return $this->render('askquestion/ask.html.twig', [
            'form' => $form->createView()

        ]);
    }



}
