<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
// ...

class ContactController extends AbstractController
{

    public function contact(Request $request): Response
    {
        $defaultData = ['message' => 'message vide'];
        $form = $this->createFormBuilder($defaultData)
            ->add('name', TextType::class ['constraints' => new Length(['min' => 3])),
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
        }

        // ... render the form
    }
}