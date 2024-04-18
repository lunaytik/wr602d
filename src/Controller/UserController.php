<?php

namespace App\Controller;

use App\Repository\PdfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{
    #[Route('/profile', name: 'app_user_profile')]
    public function index(UserInterface $user, PdfRepository $pdfRepository): Response
    {
        $currentPdfGeneratedCount = $pdfRepository->countPdfGeneratedByUserOnDate($user);
        $remainingCount = max(0, $user->getSubscription()->getPdfLimit() - $currentPdfGeneratedCount);

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'remainingCount' => $remainingCount
        ]);
    }
}
