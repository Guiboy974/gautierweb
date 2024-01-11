<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

// ...

class ContactController extends AbstractController
{

    #[Route('/contact', name: 'app.contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $defaultData = [];
        $errorMessage = '';
        $form = $this->createFormBuilder($defaultData)
            ->add('name', TextType::class, [
                'constraints' => new Length(['min' => 3]),
            ])
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class, [
                'constraints' => new Length(['min' => 3]),
            ])
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $datas = $form->getData();

            //To send mail
            try {
                $email = (new Email())
                    ->from($datas['email'])
                    ->to('you@example.com')
                    ->subject('Time for Symfony Mailer!')
                    ->text($datas['message']);
                $mailer->send($email);
                return $this->redirectToRoute('app.contact');
            } catch (TransportExceptionInterface $e) {
                $errorMessage = $e->getMessage();
            }
        }

        return $this->render('contact/contact.html.twig', [
            'errorMessage' => $errorMessage,
            'form' => $form->createView()
        ]);
    }
}