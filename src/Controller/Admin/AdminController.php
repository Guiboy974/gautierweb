<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render("admin/dashboard.html.twig");

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gautierweb');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retourner au site', 'fa fa-arrow-rotate-left', $this->'app_home');

        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::SubMenu('Catégories', 'fa fa-list')->setSubItems([
            MenuItem::linkToCrud('Voir les catégories', 'fa fa-list', Categorie::class),
            MenuItem::linkToCrud('Ajouter catégorie', 'fa fa-plus', Categorie::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::SubMenu('Medias', 'fa fa-photo-video')->setSubItems([
            MenuItem::linkToCrud('Médiathèque', 'fa fa-list', Image::class),
            MenuItem::linkToCrud('Ajouter une image', 'fa fa-plus', Image::class)->setAction(Crud::PAGE_NEW)
        ]);
    }
}
