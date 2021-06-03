<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function index(): Response
    {
        return $this->render('askquestion/ask.html.twig', [

        ]);
    }

}
