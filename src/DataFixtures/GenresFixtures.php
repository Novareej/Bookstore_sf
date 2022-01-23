<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Genre;

class GenresFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $genres = [
            1 => [
                "nom" => "Fantasy"
            ],
            2 => [
                "nom" => "Aventure"
            ],
            3 => [
                "nom" => "Thriller"
            ],
            4 => [
                "nom" => "Romance"
            ],
            5 => [
                "nom" => "Science Fiction"
            ],
            6 => [
                "nom" => "Biographie"
            ],
            7 => [
                "nom" => "Policier"
            ],
            8 => [
                "nom" => "Manga"
            ],
            9 => [
                "nom" => "Developpement personnel"
            ],
            10 => [
                "nom" => "Histoire"
            ]
        ];

        foreach ($genres as $key => $value) {
            $genre = new Genre();
            $genre->setNom($value['nom']);
            $manager->persist($genre);

            $this->addReference('genre' . $key, $genre);
        }

        $manager->flush();
    }
}
