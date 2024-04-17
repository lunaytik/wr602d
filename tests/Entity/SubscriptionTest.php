<?php

namespace App\Tests\Entity;

use App\Entity\Subscription;
use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{
    public function testGetterAndSetter()
    {
        // Création d'une instance de l'entité User
        $subscription = new Subscription();

        // Définition de données de test
        $title = 'test@test.com';
        $description = 'test';
        $pdf_limit = 10;
        $price = 10.6;

        // Utilisation des setters
        $subscription->setTitle($title);
        $subscription->setDescription($description);
        $subscription->setPdfLimit($pdf_limit);
        $subscription->setPrice($price);

        // Vérification des getters
        $this->assertEquals($title, $subscription->getTitle());
        $this->assertEquals($description, $subscription->getDescription());
        $this->assertEquals($pdf_limit, $subscription->getPdfLimit());
        $this->assertEquals($price, $subscription->getPrice());
    }
}
