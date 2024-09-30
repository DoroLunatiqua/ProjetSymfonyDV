<?php

namespace App\DataFixtures;

use App\Entity\Medecin;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MedecinFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++){
            $user = new Medecin();
            $user->setEmail('medic'.$i.'@gmail.com');
            $user->setRoles(['ROLE_MEDIC']);
            $user->setPassword($this->passwordHasher->hashPassword(
                $user,
                'ExempleMdp'
            ));
            $user->setInami('jhfbgdjd');
            $user->setNom("nom".$i);
            $user->setPrenom("prenom".$i);
            $manager->persist($user);
            $this->addReference("medecin{$i}", $user);
    }

        $manager->flush();
    }
}
