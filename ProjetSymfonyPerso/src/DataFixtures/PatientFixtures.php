<?php

namespace App\DataFixtures;

use App\Entity\Medecin;
use App\Entity\Patient;
use App\DataFixtures\MedecinFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PatientFixtures extends Fixture implements DependentFixtureInterface
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
            $user->setEmail ('user'.$i.'@gmail.com');
            $user->setPassword($this->passwordHasher->hashPassword(
                $user,
                'ExempleMdp'
            ));
            $user->setNom("nom".$i);
            $user->setPrenom("prenom".$i);
            $user->setRoles(['ROLE_PATIENT']);
            $user->setMedecinT($this->getReference("medecin{$i}"));
            
            
            $manager->persist ($user);
            $this->addReference("patient$i", $user);
        }


        $manager->flush();

    }

    public function getDependencies()
    {
        return ([MedecinFixtures::class]);
    }
}
