<?php

namespace App\DataFixtures;

use App\Entity\Subscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $subscription = new Subscription();
        $subscription->setTitle('Free');
        $subscription->setDescription('Free Subscription');
        $subscription->setPrice(0);
        $subscription->setPdfLimit(3);
        $manager->persist($subscription);

        $subscription = new Subscription();
        $subscription->setTitle('Basic');
        $subscription->setDescription('Basic Subscription');
        $subscription->setPrice(9.99);
        $subscription->setPdfLimit(10);
        $manager->persist($subscription);

        $subscription = new Subscription();
        $subscription->setTitle('Premium');
        $subscription->setDescription('Premium Subscription');
        $subscription->setPrice(29.99);
        $subscription->setPdfLimit(30);
        $manager->persist($subscription);

        $manager->flush();
    }
}
