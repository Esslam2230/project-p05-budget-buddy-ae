<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $message = $request->request->get('message');

            // Verstuur e-mail (optioneel)
            /*
            $mail = (new Email())
                ->from($email)
                ->to('jouw@email.nl')
                ->subject('Nieuw contactbericht')
                ->text($message);

            $mailer->send($mail);
            */

            $this->addFlash('success', 'Bedankt voor je bericht!');
        }

        return $this->render('contact/index.html.twig');
    }
}
