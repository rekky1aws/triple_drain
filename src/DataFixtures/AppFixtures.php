<?php

namespace App\DataFixtures;

use App\Entity\Player;
use App\Entity\Team;
use App\Entity\Category;
use App\Entity\Pinball;
use App\Entity\Score;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        $tableData = [
            "Pinball Wild Card" => [
                "The Princess Bride Pinball",
                "Goat Simulator Pinball",
                "Tomb Raider Pinball: Secrets of Croft Manor",
                "Tomb Raider Pinball: Adventures of Lara Croft"
            ],
            "Création Zen" => [
                "Super League Football",
                "Excalibur",
                "Epic Quest",
                "Wild West Rampage",
                "Sorcerer's Lair",
                "Verne's Mysterious Island",
                "A Samourai's Vengeance",
                "Wrath of the Elder Gods",
                "Grimm Tales",
                "Curse of the Mummy",
                "Pinball Noir",
                "Sky Pirates: Treasures of the Clouds",
                "Pasha",
                "Biolab",
                "Rome",
                "Secrets of the Deep",
                "Son of Zeus",
                "Adventure Land",
                "Castle Storm"
            ],
            "Brace Yourself Games" => [
                "Crypt of the NecroDancer Pinball"
            ],
            "Dreamworks Pinball" => [
                "DreamWorks Kung Fu Panda Pinball",
                "DreamWorks How to Train Your Dragon Pinball",
                "DreamWorks Trolls Pinball"
            ],
            "Game  Night Pinball" => [
                "Exploding Kittens®: A Pinball Cat-astrophe",
                "Gloomhaven™ Pinball",
                "Terraforming Mars Pinball"
            ],
            "Gearbox Pinball" => [
                "Brother in Arms®: Win the War Pinball",
                "Borderlands®: Vault Hunter Pinball",
                "Homeworld®: Journey to Hiigara Pinball"
            ],
            "Hasbro Pinball" => [
                "MY LITTLE PONY Pinball"
            ],
            "Legendary" => [
                "Pacific Rim Pinball",
                "Godzilla vs, Kong Pinball",
                "Godzilla Pinball",
                "Kong Pinball"
            ],
            "Marvel Pinball" => [
                "Marvel's Woman of Power: Champion",
                "Marvel's Woman of Power: A-Force",
                "Marvel's The Avengers",
                "The Infinity Gauntlet",
                "Fear Itself",
                "World War Hulk",
                "Marvel's Ant-Man",
                "Marvel's Avengers: Age of Ultron",
                "Guardian of the Galaxy",
                "Venom",
                "Deadpool",
                "Civil War",
                "Moon Knight",
                "X-Men",
                "Thor",
                "Ghost Rider",
                "Doctor Strange",
                "Captain America",
                "Fantastic Four",
                "Wolverine",
                "Blade",
                "Spider-Man",
                "Iron Man"
            ],
            "Nickelodeon" => [
                "Garfield Pinball"
            ],
            "Paramount" => [
                "World War Z Pinball"
            ],
            "Peanut's Pinball" => [
                "A Charlie Brown Christmas Pinball",
                "Peanuts' Snoopy Pinball"
            ],
            "Southpark Pinball" => [
                "South Park: Super-Sweet Pinball",
                "South Park: Butters' Very Own Pinball Game"
            ],
            "Star Trek Pinball" => [
                "Star Trek Pinball: Discovery",
                "Star Trek Pinball: Deep Space Nine",
                "Star Trek: Kelvin Timeline"
            ],
            "Star Wars Pinball" => [
                "Star Wars Pinball: Classic Collectibles",
                "Star Wars Pinball: The Mandalorian",
                "Star Wars Pinball: Calrissian Chronicles",
                "Star Wars Pinball: Battle of Mimban",
                "Star Wars Pinball: Solo",
                "Star Wars Pinball: Ahch-To Island",
                "Star Wars Pinball: The Last Jedi",
                "Star Wars Pinball: Rogue One",
                "Star Wars Pinball: Star Wars Rebels",
                "Star Wars Pinball: Might of the First Order",
                "Star Wars Pinball:The Force Awakens",
                "Star Wars Pinball: Masters of the Force",
                "Star Wars Pinball: Episode IV A New Hope",
                "Star Wars Pinball: Droids",
                "Star Wars Pinball: Han Solo",
                "Star Wars Pinball: Starfighter Assault",
                "Star Wars Pinball: Darth Vader",
                "Star Wars Pinball: Episode VI Return of the Jedi",
                "Star Wars Pinball: Boba Fett",
                "Star Wars Pinball: The Clone Wars",
                "Star Wars Pinball: Episode V The Empire Strikes Back"
            ],
            "Universal Pinball" => [
                "Battlestar Galactica Pinball",
                "Xena: Warrior Pricess Pinball",
                "Knight Rider Pinball",
                "Jurassic Park Pinball Mayhem",
                "Jurassic World Pinball",
                "Jurassic Park Pinball",
                "Jaws Pinball",
                "Back to the Future Pinball",
                "E.T. Pinball"
            ],
            "Williams Pinball" => [
                "Earthshaker!",
                "Banzai Run",
                "Black Knight 2000",
                "Fish Tales",
                "Star Trek: The Next Generation",
                "Twilight Zone",
                "The Addams Family",
                "World Cup Soccer",
                "Whirlwind",
                "The Machine:Bride of Pin.bot",
                "Swords of Fury",
                "Indiana Jones: The Pinball Adventure",
                "Dr.Dude and his Exellent Ray",
                "Space Station",
                "Funhouse",
                "No Good Gofers®",
                "Tales of the Arabian Nights",
                "Cirqus Voltaire",
                "Hurricane",
                "Red and Ted's Road Show",
                "White Water",
                "Champion Pub",
                "Safe Cracker",
                "Theatre of Magic",
                "The Party Zone",
                "Black Rose",
                "Attack from Mars",
                "Junk Yard",
                "The Getaway: High Speed II",
                "Medieval Madness",
                "The Creature From The Black Lagoon",
                "Monster Bash",
            ],
        ];
        
        // Teams
        /*$teams = [];
        for ($i = 0; $i < 15; $i++) {
            $teamname = $faker->word();
            
            $team = new Team();
            $team->setName("Team {$teamname}_{$i}");
            
            array_push($teams, $team);

            $manager->persist($team);
        }

        // Players
        $players = [];
        for ($i = 0;  $i < 400 ;  $i++) { 
            $firstname = $faker->firstName;

            $player = new Player();
            $player->setPseudo("{$firstname}_{$i}");
            
            $team_id = rand(0, 50 * count($teams));
            if ($team_id < count($teams)) {
                $player->setTeam($teams[$team_id]);
            }

            array_push($players, $player);

            $manager->persist($player);
        }*/

        // Categories
        $categories = [];

        $categoryNames = array_keys($tableData);

        for ($i = 0; $i < count($categoryNames); $i++) {
            $category = new Category();
            $category->setName($categoryNames[$i]);
            
            array_push($categories, $category);

            $manager->persist($category);
        }

        // Pinballs
        $pinballs = [];
        for ($i = 0; $i < count($tableData); $i++) {
            for ($j = 0; $j < count($tableData[$categoryNames[$i]]); $j++) {
                $pinball = new Pinball();
                $pinball->setName($tableData[$categoryNames[$i]][$j]);
                $pinball->setCategory($categories[$i]);

                array_push($pinballs, $pinball);

                $manager->persist($pinball);
            }
        }

        // Scores
        /*$scores = [];
        $scoreTables = [];

        for ($i = 0; $i < 5; $i++) { // $i pinball tables
            do {
                $pinInd = rand(0, count($pinballs));
            } while (in_array($pinballs[$pinInd], $scoreTables));
            array_push($scoreTables, $pinballs[$pinInd]);

            $thisTablePlayers = [];
            
            $firstScore = rand(1000, 1000000000);

            for ($j = 0; $j < 100; $j ++) { // $j players
                do {
                    $playerInd = rand(0, count($players) - 1);
                } while (in_array($players[$playerInd], $thisTablePlayers));
                array_push($thisTablePlayers, $players[$playerInd]);

                $scoreValue = floor($firstScore + ((1 + (0.1*$j)) * $firstScore));
                
                $score = new Score();
                $score->setPinball($pinballs[$pinInd]);
                $score->setPlayer($players[$playerInd]);
                $score->setValue($scoreValue);
                $score->setPosition(100 - $j);
                $score->setDate(\DateTime::createFromFormat('Y-m-d', date('Y-m-d')));

                array_push($scores, $score);

                $manager->persist($score);
            }
        }*/

        $manager->flush();
    }
}
