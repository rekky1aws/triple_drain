<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RankingsController extends AbstractController
{
    #[Route('/rankings', name: 'app_rankings')]
    public function index(): Response
    {
        return $this->render('rankings/index.html.twig', [
            'controller_name' => 'Rankings',
        ]);
    }

    #[Route('/rankings/global', name: 'app_rankings_global')]
    public function global(): Response
    {
        return $this->render('rankings/global.html.twig', [
            'controller_name' => 'Global Rankings',
        ]);
    }

    #[Route('/rankings/catgeory', name: 'app_rankings_category_selection')]
    public function categorySelection(): Response
    {
        return $this->render('rankings/categorySelection.html.twig', [
            'controller_name' => 'Category Selection',
        ]);
    }

    #[Route('/rankings/catgeory/{slug}', name: 'app_rankings_category')]
    public function category(): Response
    {
        return $this->render('rankings/category.html.twig', [
            'controller_name' => 'Category',
        ]);
    }

    #[Route('/rankings/table', name: 'app_rankings_table_selection')]
    public function tableSelection(): Response
    {
        return $this->render('rankings/tableSelection.html.twig', [
            'controller_name' => 'Table Selection',
        ]);
    }

    #[Route('/rankings/table/{slug}', name: 'app_rankings_table')]
    public function table(): Response
    {
        return $this->render('rankings/table.html.twig', [
            'controller_name' => 'Table',
        ]);
    }
}
