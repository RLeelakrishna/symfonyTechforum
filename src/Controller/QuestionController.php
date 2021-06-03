<?php


namespace App\Controller;

use App\Entity\Cars;
use App\Entity\Category;
use App\Entity\FortuneCookie;
use App\Entity\Leela;
use App\Entity\User;
use App\Repository\CarsRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class QuestionController extends AbstractController
{

    /**
     * @Route("/abc" )
     */
    public function show()
    {

        return new Response("welcome  to Symfony okokoojokookjjjjjj");
    }

    /**
     * @Route("/NSN")
     */
    public function aa(){

        return new Response("welcome  to Symfony okokoojokookjjjjjj");


    }


    /**
     * @Route("/questions/{list}")
     */
    public function home()
    {
        return new Response('hi');

    }


      /**
       * @Route("/question")
       */
      public function test()
      {

          $question = 'what is php?';

          $answers = [
              'server-site scripting lang',
              'personal home page',
          ];


          return $this->render('question/show.html.twig',[
             'answers' => $answers,
              'questions' => $question


          ]);

      }
    /**
     * @Route("/kars")
     */
    public function index()
    {



//        $repository = $this->getDoctrine()->getRepository(Cars::class);
//        $repository= $entityManager->getRepository(Cars::class);
        $cars=  $this->getDoctrine()->getManager()->getRepository(Cars::class)->allCars();
//      echo  '<pre>' ; var_dump($cars); exit;


        return $this->render('car/ask.html.twig',[
           'cars' => $cars
        ]);

    }



    /**
     * @Route("/cars")
     */


        public function cars()
        {

            $entityManager = $this->getDoctrine()->getManager();

            $cars = new Cars();
            $cars->setNames('civic');
            $cars->setPrice(800000);



            $entityManager->persist($cars);
            $entityManager->flush();

            return new Response('Saved new cars with id '.$cars->getId());

        }
    /**
     * @Route("/user")
     */
    public function user()
    {

        $entityManager = $this->getDoctrine()->getManager();

        $user = new Leela();
        $user->setUsername('prakash');




        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Saved new users with id '.$user->getId());

    }
    /**
     * @Route("/cat")
     */
    public function homepage(Request $request)
    {
//        $categoryRepository = $this->getDoctrine()
//            ->getManager()
//            ->getRepository(Category::class);

//        $categories =   $this->getDoctrine()->getManager()->getRepository(Category::class)->findAllOrdered();
//        echo '<pre>';var_dump($categories);exit;

        $search = $request->query->get('q');

        if ($search) {
            $categories =  $this->getDoctrine()->getManager()->getRepository(Category::class)->search($search);
        } else {
            $categories =  $this->getDoctrine()->getManager()->getRepository(Category::class)->findAllOrdered();
        }





        return $this->render('car/homepage.html.twig',[
            'categories' => $categories
        ]);
    }


    /**
     * @Route("/userrr")
     */
    public function userr()
    {

        $entityManager = $this->getDoctrine()->getManager();

        $user = new FortuneCookie();
        $user->setCategory('a4');
        $user->setFortune('b4');



        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Saved new fortunr with id '.$user->getId());

    }

}