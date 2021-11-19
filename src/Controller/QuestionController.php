<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class QuestionController extends AbstractController


{
    /**
     * @Route("/", name="app_base")
     */


    public function homepage(Environment $twigEnvironment)
    {

        // fun example of using the twig service directly
//        $html = $twigEnvironment->render('question/homepage.html.twig');
//
//        return new Response($html);
        return $this->render('front/contact.html.twig');
    }

    /**
     * @Route ("/question/{slug}", name="app_question_show")
     */

    public function show ($slug)
    {

        $answers = [
            'Make sure your cat is sitting perfectly still :D',
            'Ta mere est morte',
            'Ok. Je vais allez baizer ta mere',
        ];

        dump($slug, $this);


        return $this->render('question/show.html.twig', [
            'question' => ucwords(str_replace('-', ' ', $slug)),
            'answers' => $answers,
        ]);

    }
}