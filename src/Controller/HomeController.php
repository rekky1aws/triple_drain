<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController {

    #[Route("/", name:"app_home_noLocale")]
    function indexNoLocale (Request $request) : Response {
         return $this->redirectToRoute('app_home', ['_locale' => 'en']);
    }

    #[Route("/{_locale<%app.supported_locales%>}", name: "app_home")]
    function indexLocale (Request $request) : Response {
         return $this->render('home/index.html.twig', [
            'controller_name' => "Home",
            'project_name' => "PinFX Tracker"
         ]);
    }
}
