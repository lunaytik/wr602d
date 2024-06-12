<?php

namespace App\Controller;

use App\Entity\Pdf;
use App\Form\PdfForm;
use App\Repository\PdfRepository;
use App\Repository\UserRepository;
use App\Service\MicroService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PdfController extends AbstractController
{
    #[Route('/pdf', name: 'app_pdf')]
    public function index(
        MicroService $micro,
        Request $request,
        PdfRepository $pdfRepository,
        EntityManagerInterface $em,
        UserRepository $userRepository
    ): Response {
        $pdf = new Pdf();
        $form = $this->createForm(PdfForm::class, $pdf);
        $form->handleRequest($request);

        $currentUser = $userRepository->findOneBy(['email' => $this->getUser()->getUserIdentifier()]);
        $currentSubscriptionLimit = $currentUser->getSubscription()->getPdfLimit();
        $currentPdfGeneratedCount = $pdfRepository->countPdfGeneratedByUserOnDate($currentUser);
        $remainingCount = max(0, $currentSubscriptionLimit - $currentPdfGeneratedCount);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($remainingCount === 0) {
                $this->addFlash('error', 'Error to generate pdf no remaining pdf generation');

                return $this->redirectToRoute('app_pdf');
            }

            $url = $form->get('url')->getData();
            $pdfFilePath = $micro->convertUrlToPdf($url, $pdf->getTitle());

            $pdf->setOwner($this->getUser());
            $pdf->setFilePath($pdfFilePath);
            $em->persist($pdf);
            $em->flush();

            $this->addFlash('success', 'Successfully convert the url to pdf');
            return $this->redirectToRoute('app_user_profile');
        }

        return $this->render('pdf/index.html.twig', [
            'form' => $form->createView(),
            'user' => $this->getUser(),
            'remainingCount' => $remainingCount
        ]);
    }
}
