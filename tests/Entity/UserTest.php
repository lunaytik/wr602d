<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetterAndSetter()
    {
        // Création d'une instance de l'entité User
        $user = new User();

        // Définition de données de test
        $email = 'test@test.com';
        $password = 'test';
        $firstname = 'John';
        $lastname = 'Doe';
        $role = 'ROLE_USER';
        $createdAt = new \DateTimeImmutable();
        $updatedAt = new \DateTimeImmutable();
        $subscriptionEndAt = new \DateTimeImmutable();

        // Utilisation des setters
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setRoles([$role]);
        $user->setCreatedAt($createdAt);
        $user->setUpdatedAt($updatedAt);
        $user->setSubscriptionEndAt($subscriptionEndAt);

        // Vérification des getters
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($password, $user->getPassword());
        $this->assertEquals($firstname, $user->getFirstname());
        $this->assertEquals($lastname, $user->getLastname());
        $this->assertEquals([$role], $user->getRoles());
        $this->assertEquals($createdAt, $user->getCreatedAt());
        $this->assertEquals($updatedAt, $user->getUpdatedAt());
        $this->assertEquals($subscriptionEndAt, $user->getSubscriptionEndAt());
    }
}
