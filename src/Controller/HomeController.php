<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use App\Repository\ImageRepository;
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

    #[Route('/galerie/{name}-{id}',
        name: 'app_galerie',
        requirements: ['id' => '\d+'],
        defaults: ['name' => 'all', 'id' => '0']
    )]
    public function show(?Categorie $categorie, CategorieRepository $categorieRepository, ImageRepository $imageRepository): Response
    {
        $images = null === $categorie ? $imageRepository->findAll() : $imageRepository->findBy(['categorie' =>$categorie]);

        return $this->render('galerie/galerie.html.twig', [
            'name' => 'Galerie',
            'images' => $images,
            "categories" => $categorieRepository->findAll(),
        ]);
    }
}
