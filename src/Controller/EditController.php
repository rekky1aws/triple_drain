<?php

namespace App\Controller;

use App\Entity\CsvImport;
use App\Form\CsvImportType;
use App\Service\ScoreManager;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
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
    #[Route('/edit/list_csv/', name: 'app_edit_listcsv')]
    public function listCSV (EntityManagerInterface $entityManager) : Response
    {
        // List all CSV files.
        $csvFiles = $entityManager->getRepository(CsvImport::class)->findAll();

        return $this->render('edit/list_csv.html.twig', [
            'controller_name' => 'List CSV',
            'csv_files' => $csvFiles,
        ]);
    }

    #[IsGranted('ROLE_EDITOR', message: 'You are not an editor.')]
    #[Route('/edit/view_csv/{slug}', name: 'app_edit_viewcsv')]
    public function viewCSV (EntityManagerInterface $entityManager, string $slug, ScoreManager $scoreManager) : Response
    {
        // View all lines of a CSV File.
        $filename = "{$slug}.csv";
        $csvInfos = $entityManager->getRepository(CsvImport::class)->findOneBy([
            'filename' => $filename
        ]);

        if (is_null($csvInfos)) // CSV not found
        {
            // Error flash message
            $this->addFlash('error', "CSV File '{$filename}' not found, please make sure you are trying to access an existing file.");
            return $this->redirectToRoute('app_edit_listcsv');
        }

        $csvData = $scoreManager->getDataFromCsv($csvInfos->getFilename()) ;

        return $this->render('edit/view_csv.html.twig', [
            'controller_name' => "View CSV : {$filename}",
            'infos' => $csvInfos,
            'data' => $csvData,
        ]);
    }

    #[IsGranted('ROLE_EDITOR', message: 'You are not an editor.')]
    #[Route('/edit/view_csv', name: 'app_edit_nocsv')]
    public function redirectNoCSV()
    {
        return $this->redirectToRoute('app_edit_listcsv');
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

                $slug = basename($safeFilename, '.csv');

                $this->addFlash('success', "CSV File ({$safeFilename}) has been imported.");

                return $this->redirectToRoute('app_edit_viewcsv', ['slug' => $slug]);
            }
        }

        return $this->render('edit/insert_csv.html.twig',
        [
            'controller_name' => 'Edition - CSV Insertion',
            'form_data' => $form,
        ]);
    }

    #[IsGranted('ROLE_EDITOR', message: 'You are not an editor.')]
    #[Route('/edit/apply_csv/{slug}', name: 'app_edit_applycsv', methods: ["GET", "POST"])]
    public function applyCSV(EntityManagerInterface $entityManager, string $slug, ScoreManager $scoreManager): Response {
        // Use scoreManager.php to apply the data of the CSV file to the database
        try {
            $scoreManager->importScoresFromCsv("{$slug}.csv");
        } catch (Exception $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('app_edit_viewcsv', ['slug' => $slug]);
        }
        
        // Redirect to view CSV with a success message
        return $this->render(
            'edit/apply_csv.html.twig',
            [
                'controller_name' => 'Edition - Applying CSV Data to Database',
            ]
        );
    }
}
