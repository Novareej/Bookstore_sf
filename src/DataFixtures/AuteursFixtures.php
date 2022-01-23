<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Auteur;

class AuteursFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('en_US');

        for ($i = 1; $i <=20; $i++) {
            $auteur = new Auteur();
            $auteur->setNomPrenom($faker->name())
                ->setDateDeNaissance($faker->dateTime('2014-01-31'))

                ->setNationalite($faker->countryCode());
            $this->addReference('auteur' . $i, $auteur);
            $manager->persist($auteur);
        }


        $manager->flush();
    
    }
}
