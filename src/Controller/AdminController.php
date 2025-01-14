<?php

namespace App\Controller;

use App\Entity\User;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;
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

    #[IsGranted('ROLE_ADMIN', message: 'You are not an administrator.')]
    #[Route('/admin/users', name: 'app_admin_users')]
    public function usersManager(EntityManagerInterface $entityManager): Response
    {   
        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->render('admin/usersManager.html.twig', [
            'controller_name' => 'Admin - Users Manager',
            'users' => $users,
        ]);
    }

    #[Route('/admin/edit_user/{id}', name: 'app_admin_edit_user')]
    #[IsGranted('ROLE_ADMIN', message: 'You are not an administrator.')]
    public function usersEditor(EntityManagerInterface $entityManager, User $user): Response
    {
        /*
            Form to edit a given user
            Get all possible roles and make a menu to add or delete roles to an existing user.
        */
        return $this->render('admin/userEditor.html.twig', [
            'controller_name' => 'Admin - Users Editor',
            'user' => $user,
            // 'roles' => $roles
        ]);
    }
}
