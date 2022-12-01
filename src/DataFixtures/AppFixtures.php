<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Ville;
use App\Entity\Aeroport;
use App\Entity\Company;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        // Villes & Aéroports
        for ($i = 1; $i <= 5; $i++) {

            $aeroport = new Aeroport();
            $aeroport
                ->setNom("Aéroport $i")
                ->setNbPistes($i);
            $manager->persist($aeroport);

            $ville = new Ville();
            $ville
                ->setNom($faker->city())
                ->setDepartement($faker->departmentName())
                ->setPopulation($faker->randomNumber(6))
                ->addAeroport($aeroport);

            if ($i % 2 == 0) {
                $aeroport = new Aeroport();
                $aeroport
                    ->setNom("Aéroport $i bis")
                    ->setNbPistes($i);
                $manager->persist($aeroport);
                $ville->addAeroport($aeroport);
            }

            $manager->persist($ville);
        }

        // Compagnies
        for ($i = 1; $i <= 5; $i++) {
            $company = new Company();
            $company
                ->setNom("Compagnie $i")
                ->setSigle("C_$i")
                ->setEmployes(mt_rand(50, 1000));
            $manager->persist($company);
        }

        $manager->flush();
    }
}
