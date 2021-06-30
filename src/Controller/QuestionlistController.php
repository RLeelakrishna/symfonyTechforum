<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
//
///**
// *
// * @IsGranted("ROLE_USER")
// */

class QuestionlistController extends AbstractController
{
    /**
     * @Route("/questionlist", name="app_Qlist")
     */
    public function list(Request $request,PaginatorInterface $paginator,EntityManagerInterface $em,QuestionRepository $questionRepository): Response
    {
     $form = $this->createFormBuilder(null)
            ->add('query',TextType::class)
            ->add('search',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();

        $query = $request->request->get('form')['query'];

        if($query){
            $posts = $questionRepository->questionlist($query);
            dd($posts);
        }

        $questionslist = $em->getRepository(Question::class);
        $query = $questionslist->createQueryBuilder('d')
            ->orderBy('d.id', 'DESC')
            ->getQuery();

            $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page',1 ),
            4

        );


        return $this->render('questionlist/Qlist.html.twig', [
            'form' =>$form->createView(),
            'questions' => $query,
            'pagination' =>  $pagination,
        ]);
    }
    public function add($num1,$num2){
        return $num1 + $num2;

    }

    public function subtract($num1,$num2){
        return $num1 - $num2;

    }
}
