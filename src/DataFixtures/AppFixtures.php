<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 0;  $i < 20 ;  $i++) { 
            $firstname = $faker->firstName;

            $player = new Player();
            $player->setPseudo("{$firstname}_{$i}");

            $manager->persist($player);
        }

        $manager->flush();
    }
}
