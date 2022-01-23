<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Livre;
use Faker\Factory;


class LivresFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('en_US');

        
        $livres = file_get_contents("src\db\books_converted.json");
        $json_a = json_decode($livres, true);


        for ($i = 1; $i <=50; $i++) {
            $livre = new Livre();
            for ($j = 1; $j <= $faker->numberBetween(1, 2); $j++) {
                $livre->addAuteur($this->getReference('auteur' . $faker->numberBetween(1, 20)));
            }
            for ($j = 1; $j <= $faker->numberBetween(1, 2); $j++) {
                $livre->addGenre($this->getReference('genre' . $faker->numberBetween(1, 10)));
            }
           
            if ($json_a[$i]['isbn13'] !== NULL) {
                $livre->setIsbn($json_a[$i]['isbn13']);
            }
            $livre->setTitre($json_a[$i]['title'])
            ->setNombrePages($json_a[$i]['num_pages'])
            ->setDateDeParution($faker->dateTimeBetween($startDate = '1900-01-01', $endDate = '2021-01-01', $timezone = null));


            $manager->persist($livre);
        }


        $manager->flush();
    }
}


