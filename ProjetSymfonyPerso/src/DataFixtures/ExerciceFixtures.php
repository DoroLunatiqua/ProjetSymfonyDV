<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use App\Enum\ThemeExo;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ExerciceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_BE");
        


        for ($i = 0; $i < 20 ; $i++){
            $exercice = new Exercice();
            $exercice->setThemeExo(ThemeExo::cases()[rand(0,3)]);
            $exercice->setReponse($faker->sentence());
            $exercice->setQuestion($faker->catchPhrase()."?");
            $exercice->setNom($faker->word());
            $exercice->setQuestion2($faker->catchPhrase()."?");
            $exercice->setQuestion3($faker->catchPhrase()."?");
            $exercice->setQuestion4($faker->catchPhrase()."?");
            $exercice->setQuestion5($faker->catchPhrase()."?");

            $manager->persist($exercice);
            $this->addReference("exercice$i", $exercice);
        }
        $manager->flush();
    }


}
