<?php

require_once "./vendor/autoload.php";

use App\DataParsers\HomeOwnerParser;
use App\Factories\PersonFactory;
use App\Reader\CsvFileReader;

$csvReader       = new CsvFileReader();
$data            = $csvReader->read('examples.csv')->getData();
$personFactory   = new PersonFactory();
$homeOwnerParser = new HomeOwnerParser($personFactory);
$list            = $homeOwnerParser->setData($data)->parse();

echo "<pre>";
print_r($list);
echo "</pre>";