<?php

namespace App\Controller;

use App\Entity\Answers;
use App\Entity\Question;
use App\Form\EditAnswer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditAnswerController extends AbstractController
{
    /**
     * @Route("/edit/answer/{id}", name="edit_answer")
     */
    public function editanswer(Request $request,Answers $answers,EntityManagerInterface $em): Response
    {
        $answerEdit = $this->createForm(EditAnswer::class,$answers);
        $answerEdit->handleRequest($request);

        if($answerEdit->isSubmitted() && $answerEdit->isValid()) {
            $em->persist($answers);
            $em->flush();
            return $this->redirectToRoute('answers',array('id'=>$id));

        }




        return $this->render('edit_answer/editAnswer.html.twig', [
            'editForm' => $answerEdit->createView()


        ]);
    }
}
