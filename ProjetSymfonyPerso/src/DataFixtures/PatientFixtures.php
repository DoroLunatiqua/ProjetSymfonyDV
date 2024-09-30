<?php

namespace App\DataFixtures;

use App\Entity\Patient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PatientFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10 ; $i++){
            $user = new Patient();
            $user->setEmail ('user'.$i.'gmail.com');
            $user->setPassword($this->passwordHasher->hashPassword(
                $user,
                'ExempleMdp'
            ));
            $user->setNom("nom".$i);
            $user->setPrenom("prenom".$i);
            $user->setMedecin($this->getReference("medecin" . rand(10,19))); 


            $manager->persist ($user);
        }


        $manager->flush();
    }
}
