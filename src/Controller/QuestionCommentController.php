<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionCommentController extends AbstractController
{
    /**
     * @Route("/question/comment", name="question_comment")
     */
    public function questionComment(): Response
    {
        return $this->render('question_comment/questionComment.html.twig', [

        ]);
    }
}
