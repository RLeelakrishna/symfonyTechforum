<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends AbstractController
{
//    /**
//     * @Route("/")
//     */
//    public function show()
//    {
//
//        return new Response("welcome  to Symfony okokoojokookjjjjjj");
//    }

//    /**
//     * @Route("/question", name="question_list")
//     */
//    public function home()
//    {
//
//        return new Response("good morning");
//    }
      /**
       * @Route("/")
       */
      public function show()
      {
          $answers = [
              'Make sure your cat is sitting perfectly still 🤣',
              'Honestly, I like furry shoes better than MY cat',
              'Maybe... try saying the spell backwards?',
          ];
          return $this->render('question/show.html.twig',[
             'answers' => $answers
          ]);
      }
}