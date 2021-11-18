<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    public function homepage()
    {
        return $this->render('question/homepage.html.twig');
    }

    /**
     * @Route ("/question/{slug}")
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