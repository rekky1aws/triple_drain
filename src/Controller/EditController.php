<?php

namespace App\Controller;

use App\Entity\CsvImport;
use App\Form\CsvImportType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
        // Editor menu : 
        // List all possible actions for the editors :
        //  + view CSV list.
        //  + view a given CSV file.
        //  + insert a CSV file.

        return $this->render('edit/index.html.twig', [
            'controller_name' => 'Edition',
        ]);
    }

    #[IsGranted('ROLE_EDITOR', message: 'You are not an editor.')]
    #[Route('/edit/view_csv/', name: 'app_edit_listcsv')]
    public function listCSV () : Response
    {
        // List all CSV files.

        return $this->render('edit/list_csv.html.twig', [
            'controller_name' => 'List CSV',
        ]);
    }

    #[IsGranted('ROLE_EDITOR', message: 'You are not an editor.')]
    #[Route('/edit/view_csv/{slug}', name: 'app_edit_viewcsv')]
    public function checkCSV () : Response
    {
        // View all lines of a CSV File.

        return $this->render('edit/view_csv.html.twig', [
            'controller_name' => 'View CSV',
        ]);
    }

    #[IsGranted('ROLE_EDITOR', message: 'You are not an editor.')]
    #[Route('/edit/insert_csv', name: 'app_edit_insertcsv', methods: ["GET", "POST"])]
    public function insertCSV (Request $request, EntityManagerInterface $entityManager, Security $security, #[Autowire('%kernel.project_dir%/public/uploads/csvImports')] string $csvDirectory): Response
    {   
        // Use the current User for the 'imported_by' field. 
        // $current_user = $security->getUser();

        $csvImport = new CsvImport();
        $form = $this->createForm(CsvImportType::class, $csvImport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $insertion = $form->getData();
            $csvFile = $form->get('file')->getData();

            if ($csvFile) {
                // Make it safer by directly definig the filename here (Y-m-d_H-m-s.csv)
                // Don't forget to use this filename to save in DB.
                $safeFilename = $form->get('filename')->getData();
                
                try {
                    $csvFile->move($csvDirectory, $safeFilename);
                } catch (FileException $e) {

                }

                $entityManager->persist($insertion);
                $entityManager->flush();
            }
        }

        return $this->render('edit/insert_csv.html.twig',
        [
            'controller_name' => 'Edition - CSV Insertion',
            'form_data' => $form,
        ]);
    }
}
