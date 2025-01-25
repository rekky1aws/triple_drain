<?php

namespace App\Controller;

use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TeamsController extends AbstractController
{
    #[Route('/teams', name: 'app_team_selection')]
    public function teamSelection(EntityManagerInterface $entityManager): Response
    {
        $teams = $entityManager->getRepository(Team::class)->findAll();

        return $this->render('teams/teamSelection.html.twig', [
            'controller_name' => 'Team Selection',
            'teams' => $teams
        ]);
    }

    #[Route('/team/{id}', name: 'app_team')]
    public function index(): Response
    {
        return $this->render('teams/team.html.twig', [
            'controller_name' => 'Team',
        ]);
    }
}
