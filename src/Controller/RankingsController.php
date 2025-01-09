<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Pinball;
use App\Entity\Score;

use Doctrine\ORM\EntityManagerInterface;

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

    // DEBUG
    #[Route('/rankings/test', name: 'app_rankings_test')]
    public function test(EntityManagerInterface $entityManager): Response
    {
        $pinball_machines = $entityManager->getRepository(Pinball::class)->find(0);

        var_dump($pinball_machines);

        return $this->render('rankings/test.html.twig', [
            'controller_name' => 'Rankings TEST',
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

    #[Route('/rankings/catgeory/{id}', name: 'app_rankings_category')]
    public function category(): Response
    {
        return $this->render('rankings/category.html.twig', [
            'controller_name' => 'Category',
        ]);
    }

    #[Route('/rankings/table', name: 'app_rankings_table_selection')]
    public function tableSelection(EntityManagerInterface $entityManager): Response
    {
        $pinball_machines = $entityManager->getRepository(Pinball::class)->findAll();

        return $this->render('rankings/tableSelection.html.twig', [
            'controller_name' => 'Table Selection',
            'tables' => $pinball_machines
        ]);
    }

    #[Route('/rankings/table/{id}', name: 'app_rankings_table')]
    public function tableId(EntityManagerInterface $entityManager, int $id): Response
    {
        $pinball_machine = $entityManager->getRepository(Pinball::class)->find($id);
        $scores = $pinball_machine->getScores();

        if (is_null($pinball_machine)) { // If table doesn't exist display error.
            return $this->render('rankings/tableError.html.twig', [
                'controller_name' => 'Table does not exist',
                'table_id' => $id
            ]);
        }

        if (empty($scores)) { // If this table doesn't have any score registered.
            return $this->render('rankings/tableEmpty.html.twig', [
                'controller_name' => 'Empty Table'
            ]);
        }

        return $this->render('rankings/table.html.twig', [
            'controller_name' => 'Rankings - '.$pinball_machine->getName(),
            'table' => $pinball_machine,
            'category' => $pinball_machine->getCategory(),
            'scores' => $scores
        ]);
    }
}
