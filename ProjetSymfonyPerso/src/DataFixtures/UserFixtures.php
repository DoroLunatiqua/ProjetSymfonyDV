<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10 ; $i++){
            $user = new User();
            $user->setEmail ('user'.$i.'gmail.com');
            $user->setPassword($this->passwordHasher->hashPassword(
                $user,
                'ExempleMdp'
            ));
            $user->setNom("nom".$i);
            $user->setPrenom("prenom".$i);


            $manager->persist ($user);
        }

        $manager->flush();
    

    for ($i = 10; $i < 20; $i++){
        $user = new User();
        $user->setEmail('admin'.$i.'@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'ExempleMdp'
        ));
        
        
        $user->setNom("nom".$i);
        $user->setPrenom("prenom".$i);


        
        
        $manager->persist($user);
}
    $manager->flush();
    }
}
