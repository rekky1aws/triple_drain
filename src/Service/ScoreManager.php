<?php

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class ScoreManager
{
  public function getDataFromCsv (string $csvFilename, #[Autowire('%kernel.project_dir%/public/uploads/csvImports')] string $csvDirectory): ?array
  {
    // Open file, if not found throw an error.
    if (($fp = fopen("{$csvDirectory}/{$csvFilename}", "r")) == FALSE) {
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
}