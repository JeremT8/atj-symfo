<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route("/docs")]
class DocumentationController extends AbstractController
{
    #[Route('/', name: 'docs')]
    public function index(): Response
    {
        return $this->render('docs/index.html.twig', [
            'controller_name' => 'DocumentationController',
        ]);
    }
}
