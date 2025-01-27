<?php

namespace App\Controller;

use App\Entity\CsvImport;
use App\Form\CsvImportType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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
    #[Route('/edit/check_csv', name: 'app_edit_checkcsv')]
    public function checkCSV () : Response
    {
        return $this->render('edit/index.html.twig', [
            'controller_name' => 'Edition',
        ]);
    }

    #[IsGranted('ROLE_EDITOR', message: 'You are not an editor.')]
    #[Route('/edit/insert_csv', name: 'app_edit_insertcsv', methods: ["GET", "POST"])]
    public function insertCSV (Request $request, EntityManagerInterface $entityManager): Response
    {   
        $csvImport = new CsvImport();
        $form = $this->createForm(CsvImportType::class, $csvImport, [
            'action' => $this->generateUrl('app_edit_checkcsv')
        ]);
        $form->handleRequest($request);

        // dd($form->isSubmitted());

        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->get('file'));
            $entityManager->flush();
        }

        return $this->render('edit/insert_csv.html.twig',
        [
            'controller_name' => 'Edition - CSV Insertion',
            'form_data' => $form,
        ]);
    }
}
