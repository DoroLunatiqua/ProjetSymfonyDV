<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AssignationExercicesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $patient = $this->getReference('patient' . $i);

            // Track assigned exercises to avoid duplicates
            $assignedExercises = [];

            // Assign random number (between 1 and 5) of exercises to each patient
            $numberOfExercises = rand(1, 5);

            for ($j = 0; $j < $numberOfExercises; $j++) {
                do {
                    // attention au nombre d'exercices
                    $randomExerciseIndex = rand(0, 19);
                } while (in_array($randomExerciseIndex, $assignedExercises));

                // Mark this exercise as assigned
                $assignedExercises[] = $randomExerciseIndex;

                // Get the exercise reference
                $exercise = $this->getReference('exercice' . $randomExerciseIndex);

                // Add the exercise to the patient
                $patient->addExercicesAssigne($exercise);
            }

            $manager->persist($patient);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PatientFixtures::class,
            ExerciceFixtures::class,
        ];
    }
}
