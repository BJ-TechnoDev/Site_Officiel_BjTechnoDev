<?php

namespace App\Controller;

use App\Form\ContactType;
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


    public function index(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();

            $message = (new Email())
                ->from($contactFormData['email'])
                ->to('bastien.98@orange.fr')
                ->subject($contactFormData['subject'])
                ->text('Name: '.$contactFormData['fullName'].\PHP_EOL.'Subject: '.$contactFormData['subject'].\PHP_EOL.'Email: '.$contactFormData['email'].\PHP_EOL. 'Message: '.$contactFormData['message'],
                    'text/plain');
            try {
                $mailer->send($message);

                $this->addFlash('success', '✅ Your message has been sent!');
            } catch (TransportExceptionInterface $e) {
                $this->addFlash('error', '❌ Your message has an error!');
            }
            return $this->redirectToRoute('homepage');
        }



        return $this->render('front/index.html.twig', [
            'our_form' => $form->createView()
        ]);




    }

}
