<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/home.html.twig', [
            'name' => 'Gautier',
        ]);
    }

    #[Route('/galerie/galerie.html.twig', name: 'app_galerie')]
    public function show(): Response
    {
        return $this->render('galerie/galerie.html.twig', [
            'name' => 'Galerie',
            'images' => array_filter(scandir("../public/images/galerie"), function ($val){return $val[0] != ".";})
        ]);
    }
}
