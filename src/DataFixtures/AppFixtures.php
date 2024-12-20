<?php

namespace App\DataFixtures;

use App\Entity\Player;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        
        // Teams
        $teams = [];
        for ($i = 0; $i < 5; $i++) {
            $teamname = $faker->word();
            
            $team = new Team();
            $team->setName("Team {$teamname}");
            
            array_push($teams, $team);

            $manager->persist($team);
        }

        // Players
        for ($i = 0;  $i < 20 ;  $i++) { 
            $firstname = $faker->firstName;

            $player = new Player();
            $player->setPseudo("{$firstname}_{$i}");
            
            $team_id = rand(0, 15);
            if ($team_id < count($teams)) {
                $player->setTeam($teams[$team_id]);
            }

            $manager->persist($player);
        }
        
        $manager->flush();
    }
}
