<?php

namespace App\Controller;

use App\Entity\AnswerComments;
use App\Entity\Answers;
use App\Form\AnswerComment;
use App\Repository\AnswerCommentsRepository;
use App\Repository\AnswersRepository;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment/{id}", name="comment")
     */
    public function answerComment(Request $request,QuestionRepository $questionRepository): Response
    {


        $id = (int)$request->get('id');

        $em = $this->getDoctrine()->getManager();
        $answer_comments = new AnswerComments();
        $answer_comments->setUser($this->getUser());

        $answer_id =$em->getRepository(Answers::class)->find($id);
//        dd($answer_id);
        $answer_comments->setAnswer($answer_id);

        $answer_comments->setUpdatedAt(new \DateTime());
        $answer_comments->setCreatedAt(new \DateTime());

        $commentform = $this->createForm(AnswerComment::class,$answer_comments);
        $commentform->handleRequest($request);



        if($commentform->isSubmitted() && $commentform->isValid()){
            $em->persist($answer_comments);
            $em->flush();
//            return $this->redirectToRoute('answers',array('id'=>8));


        }
        $question = $questionRepository->findAll();



        return $this->render('comment/answerComment.html.twig', [
            'form' =>$commentform->createView(),
            'question' =>$question

        ]);
    }
}
