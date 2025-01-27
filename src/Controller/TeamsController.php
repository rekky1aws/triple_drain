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
    public function index(EntityManagerInterface $entityManager, int $id): Response
    {
        $team = $entityManager->getRepository(Team::class)->find($id);

        if (is_null($team)) { // If team doesn't exist display error.
            return $this->render('teams/teamError.html.twig', [
                'controller_name' => 'Team does not exist',
                'team_id' => $id
            ]);
        }

        return $this->render('teams/team.html.twig', [
            'controller_name' => 'Team',
            'team' => $team
        ]);
    }
}
