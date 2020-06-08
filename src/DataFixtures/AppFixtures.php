<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Création d'un nouvel objet Faker
        $faker = Factory::create('fr_FR');

        // Création entre 15 et 30 tâches aléatoirement
        for ($t = 0; $t < mt_rand(15, 30); $t++) {

            // Création d'un nouvel objet Task
            $task = new Task;

            // On nourrit l'objet Task
            $task->setName($faker->sentence(6))
                ->setDescription($faker->paragraph(3))
                ->setCreatedAt(new \DateTime()) // Attention les dates sont crées en fonction du réglage serveur
                ->setDueAt($faker->dateTimeBetween('now', '+ 10 days')); // de même ici

            // On fait persister les données
            $manager->persist($task);
        }

        // On push le tout en BDD
        $manager->flush();
    }
}