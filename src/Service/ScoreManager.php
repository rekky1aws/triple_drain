<?php

namespace App\Service;

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


    return $this;
  }
}