<?php

declare(strict_types=1);

header('content-type: application/json');

require_once __DIR__ . '/../vendor/autoload.php';

use Temper\Assignment\Infra\CSVParser;
use Temper\Assignment\Infra\WeekGrouper;
use Temper\Assignment\Infra\WeekPercentageCalculator;
use Temper\Assignment\UserInterface\Rest\HighchartsMapper;

$csvParser            = new CSVParser(__DIR__ . '/../data/export.csv');
$weekGrouper          = new WeekGrouper($csvParser->parse());
$percentageCalculator = new WeekPercentageCalculator($weekGrouper->group());
$highchartsMapper     = new HighchartsMapper($percentageCalculator->count());

echo $_GET['callback']. '('. json_encode($highchartsMapper->map()) . ')';
