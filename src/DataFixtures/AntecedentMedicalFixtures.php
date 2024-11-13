<?php

namespace App\DataFixtures;

use App\Entity\AntecedentMedical;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AntecedentMedicalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for( $i = 0; $i < 10 ; $i++){
            $dossier = new AntecedentMedical();
            $dossier->setNumeroDossier ('numeroABC' . $i);
            $dossier->setObservation("texte d'observation");
            $dossier->setPatient($this->getReference("patient$i"));
            $manager->persist ($dossier);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return ([PatientFixtures::class]);
    }
}
