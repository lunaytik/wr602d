<?php

namespace App\Controller;

use App\Entity\Pdf;
use App\Form\PdfForm;
use App\Service\MicroService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PdfController extends AbstractController
{
    #[Route('/pdf', name: 'app_pdf')]
    public function index(MicroService $micro, Request $request): Response
    {
        $pdfFilePath = $micro->convertUrlToPdf('https://twitter.com');

        return $this->render('pdf/index.html.twig', [
            'controller_name' => 'PdfController',
        ]);
    }
}
