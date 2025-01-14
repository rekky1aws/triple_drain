<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    #[IsGranted('ROLE_ADMIN', message: 'You are not an administrator.')]
    public function index(): Response
    {   
        // $this->denyAccessUnlessGranted('ROLE_ADMIN', null, "You are not an administrator.");

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'Admin',
        ]);
    }

    #[Route('/admin/users', name: 'app_admin_users')]
    public function usersManager(): Response
    {   
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, "You are not an administrator.");

        return $this->render('admin/users.html.twig', [
            'controller_name' => 'Admin - Users Manager',
        ]);
    }
}
