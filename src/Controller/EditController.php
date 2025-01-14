<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EditController extends AbstractController
{
    #[IsGranted('ROLE_EDITOR', message: 'You are not an editor.')]
    #[Route('/edit', name: 'app_edit')]
    public function index(): Response
    {
        return $this->render('edit/index.html.twig', [
            'controller_name' => 'Edition',
        ]);
    }

    #[IsGranted('ROLE_EDITOR', message: 'You are not an editor.')]
    #[Route('/edit/insert_csv', name: 'app_edit_insertcsv')]
    public function insertCSV (): Response
    {
        return $this->render('edit/insert_csv.html.twig',
        [
            'controller_name' => 'Edition - CSV Insertion'
        ]);
    }
}
