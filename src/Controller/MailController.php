<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{

    /**
     * @Route("/emails")
     */


    public function sendEmail(MailerInterface $mailer, RequestStack $requestStack)
    {

        $email = (new Email())
            ->from('bibidelfuegoo@gmail.com')
            ->to('bastien.98@orange.fr')
            ->subject('Time for Symfony Mailer!')
            ->text($this->renderView('emails/signup.html.twig'))
            ->html($this->renderView('emails/signup.html.twig'))
        ;

        $mailer->send($email);

        dump($requestStack);

        return $this->render('front/index.html.twig');

}

}

