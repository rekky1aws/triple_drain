<?php

namespace App\Service;

use App\Entity\Pinball;
use App\Entity\Player;
use App\Entity\Score;
use Exception;
use Doctrine\ORM\EntityManagerInterface;

class ScoreManager
{
  private $csvDirectory;
  private $entityManager;

  public function __construct(string $csvDirectory, EntityManagerInterface $entityManager)
  {
    $this->csvDirectory = $csvDirectory;
    $this->entityManager = $entityManager;
  }

  public function getDataFromCsv (string $csvFilename): ?array
  {
    // Open file, if not found throw an error.
    if (($fp = fopen("{$this->csvDirectory}/{$csvFilename}", "r")) == FALSE) {
      throw new Exception("The requested file was not found, please make sure you request an existing file.", 1);
    }

    $csvData = [];
    
    // First line with CSV headers
    $line = fgets($fp);

    // Reading all lines
    while (($line = fgets($fp)) !== FALSE) {
      array_push($csvData, str_getcsv($line));
    }
    
    fclose($fp);

    return $csvData;
  }

  public function importScoresFromCsv (string $csvFilename) :static
  {
    $csvData = $this->getDataFromCsv($csvFilename);
    foreach ($csvData as $index => $line) {
      // Ignore empty lines
      if ($line[0] == "" || $line[1] =="" || $line[2] =="" || $line[3] == "") {
        continue;
      }

      $score = new Score();

      // PINBALL
      $pinball = $this->entityManager->getRepository(Pinball::class)->findOneBy([
        'name' => $line[0]
      ]);
      
      if (is_null($pinball)) {
        dd($line, $index);
        throw new Exception("Error on line $index in $csvFilename. This pinball table doesn't exist in database. Please make sure the CSV file only contains existing tables.");
      }      
      $score->setPinball($pinball);

      // POSITION
      $position = intval($line[1]);
      if ($position < 1 || $position > 100) {
        dd($line);
        throw new Exception("Error on line $index in $csvFilename. Position can only be a value between 1 and 100");
      }
      $score->setPosition($line[1]);

      // POINTS
      if ($position <= 50) {
        $score->setTop50Points((51 - $position) * 2);
      } else {
        $score->setTop50Points(0);
      }
      $score->setTop100Points(101 - $position);

      // PLAYER
      $player = $this->entityManager->getRepository(Player::class)->findOneBy([
          'pseudo' => $line[2]
        ]);

      if (is_null($player)) {
        $player = new Player();
        $player->setPseudo($line[2]);
        $this->entityManager->persist($player);
        $this->entityManager->flush();
      }
      $score->setPlayer($player);

      // VALUE
      $value = intval(str_replace("\u{202F}", "",  $line[3]));

      if ($value <= 0) {
        throw new Exception("Error on line $index in $csvFilename. Score values should only be positive integers.");
      }
      
      $score->setValue($value);

      // DATE
      $dateText = substr($csvFilename, 0, 10)."_00-00-00";
      $date = date_create_from_format('Y-m-d_H-m-s', $dateText);
      $score->setDate($date);

      // PERSIST
      $this->entityManager->persist($score);
      $this->entityManager->flush();
      $this->entityManager->clear();

      dump(get_defined_vars());

    }



    return $this;
  }
}