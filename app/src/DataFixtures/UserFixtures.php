<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Equipements;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordHasherInterface $hasher) 
{
    $this->encoder = $hasher;

}
    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $manager->flush();
    }

    
public function loadUsers(ObjectManager $manager): void
{
    // Liste des utilisateurs à créer
    $usersData = [
        [
            'email' => 'guest@toto.fr',
            'roles' => ['ROLE_USER'],
            'password' => 'toto',
            'isHost' => false
        ],
        [
            'email' => 'host@toto.fr',
            'roles' => ['ROLE_USER'],
            'password' => 'toto',
            'isHost' => true
        ],
    ];

    foreach ($usersData as $userData) {
        $user = new User();
        $user->setEmail($userData['email']);
        $user->setRoles($userData['roles']);
        $user->setPassword($this->encoder->hashPassword($user, $userData['password']));
        $user->setIsHost($userData['isHost']);
        $manager->persist($user);
    }
}

}