<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request ,QuestionRepository $questionRepository): Response
    {


         $data = $questionRepository->questionlist();
         dd($data);


//        return $this->render('search/searchh.html.twig', [
//
//        ]);
    }


}
