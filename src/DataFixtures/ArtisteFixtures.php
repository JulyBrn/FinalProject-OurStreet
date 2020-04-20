<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Artiste;

class ArtisteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $artiste = new Artiste();
            $artiste->setName("Nom de l'artiste numéro $i")
                    ->setContent("<p>Bio de l'artiste numéro $i</p>")
                    ->setImage("http://placehold.it/350x150");

            $manager->persist($artiste);
        }

        $manager->flush();
    }
}
