<?php

namespace App\Controller;

use App\Entity\Subscription;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SubscriptionController extends AbstractController
{
    #[Route('/subscription', name: 'app_subscription')]
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {
        return $this->render('subscription/index.html.twig', [
            'subscriptions' => $subscriptionRepository->findAll(),
            'user' => $this->getUser()
        ]);
    }

    #[Route('/subscription/change/{id}', name: 'app_subscription_change')]
    public function change(Subscription $subscription, EntityManagerInterface $em): Response
    {
        $currentUser = $this->getUser();
        $currentUser->setSubscription($subscription);
        $currentUser->setSubscriptionEndAt(new \DateTimeImmutable('+1 month'));
        $em->flush();

        $this->addFlash('success', 'Successfully changed the subscription level');

        return $this->redirectToRoute('app_subscription');
    }
}
