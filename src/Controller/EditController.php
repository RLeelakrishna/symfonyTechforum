<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\EditQuestion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditController extends AbstractController
{
    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editQuestion(Request $request,Question $question,EntityManagerInterface $em): Response
    {

        $edit = $this->createForm(EditQuestion::class,$question);
        $edit->handleRequest($request);

        if($edit->isSubmitted() && $edit->isValid()) {
          $em->persist($question);
          $em->flush();
            return $this->redirectToRoute('answers',array('id'=>8));


        }






        return $this->render('edit/editQuestion.html.twig', [
            'editForm' => $edit->createView()
        ]);
    }
}
