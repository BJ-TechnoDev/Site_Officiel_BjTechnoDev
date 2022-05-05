<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ProjetRepository;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact")
     */


    public function index(Request $request, MailerInterface $mailer, ProjetRepository $repo, Recaptcha3Validator $recaptcha3Validator)
    {
        $proj = $repo->findAll();
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();
            $message = (new Email())
                ->from($contactFormData['email'])
                ->to('bjtechnodev@gmail.com')
                ->subject($contactFormData['subject'])
                ->text('Name: ' . $contactFormData['fullName'] . \PHP_EOL . 'Subject: ' . $contactFormData['subject'] . \PHP_EOL . 'Email: ' . $contactFormData['email'] . \PHP_EOL . 'Message: ' . $contactFormData['message'],
                    'text/plain');
            try {
                $mailer->send($message);

                $this->addFlash('success', '✅ Votre message a bien été envoyé!');
            } catch (TransportExceptionInterface $e) {
                $this->addFlash('error', '❌ Une erreur c\'est produite!');
            }
            return $this->redirectToRoute('homepage');
        }


        return $this->render('front/index.html.twig', [
            'our_form' => $form->createView(),
            'projets' => $proj
        ]);


    }

}