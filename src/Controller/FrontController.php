<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(ProjetRepository $repo): Response
    {
        $proj = $repo->findAll();

        return $this->render('front/index.html.twig', ['projets' => $proj]);
    }


}
