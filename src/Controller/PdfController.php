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
        $pdf = new Pdf();
        $form = $this->createForm(PdfForm::class, $pdf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $url = $form->get('url')->getData();
            $pdfFilePath = $micro->convertUrlToPdf($url, $pdf->getTitle());

            $pdf->setOwner($request->getUser());
            $pdf->setFilePath($pdfFilePath);

            $this->addFlash('success', 'Successfully convert the url to pdf');
        }

        return $this->render('pdf/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
