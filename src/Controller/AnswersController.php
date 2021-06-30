<?php

namespace App\Controller;

use App\Entity\AnswerComments;
use App\Entity\Answers;
use App\Entity\Question;
use App\Entity\QuestionComments;
use App\Form\Answer;
use App\Form\AnswerComment;
use App\Form\QuestionComment;
use App\Repository\AnswerCommentsRepository;
use App\Repository\AnswersRepository;
use App\Repository\QuestionCommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnswersController extends AbstractController
{
    /**
     * @Route("/answers/{id}", name="answers")
     */
    public function answers(Request $request,AnswersRepository $answersRepository,AnswerCommentsRepository $ac,QuestionCommentsRepository $qc): Response
    {
        $id = (int)$request->get('id');

        $question = $this->getDoctrine()->getManager()->getRepository(Question::class);
        $query = $question->getQuestion($id);


        $em = $this->getDoctrine()->getManager();

        $answers = new Answers();
        $answers->setUser($this->getUser());
        $idq = $em->getRepository(Question::class)->find($id);
        $answers->setQuestion($idq);
        $answers->setCreatedAt(new \DateTime());
        $answers->setUpdatedAt(new \DateTime());

        $answersForm =  $this->createForm(Answer::class,$answers);
        $answersForm->handleRequest($request);

        if($answersForm->isSubmitted() && $answersForm->isValid()){
            $em->persist($answers);
            $em->flush();

        }

        $questionComments = new QuestionComments();
        $questionComments->setUser($this->getUser());
        $questionComments->setQuestion($idq);
        $questionComments->setCreatedAt(new \DateTime());
        $questionComments->setUpdatedAt(new \DateTime());

        $questionCommentsForm = $this->createForm(QuestionComment::class,$questionComments);
        $questionCommentsForm->handleRequest($request);

        if($questionCommentsForm->isSubmitted() && $questionCommentsForm->isValid()){
            $em->persist($questionComments);
            $em->flush();
        }









        $answer = $answersRepository->getAnswer($id);

        $answercommentss = $ac->getComment();

        $questioncommentss =  $qc->getQuestionComment($id);



        return $this->render('answers/answers.html.twig', [
            'query' => $query,
            'answers' => $answersForm->createView(),
            'answer' =>$answer,
            'answercomment' => $answercommentss,
            'questioncomment' => $questionCommentsForm->createView(),
            'questionCommentss' => $questioncommentss
        ]);
    }
}
