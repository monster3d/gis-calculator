<?php

include "vendor/autoload.php";

$lat1 = 56.837744;
$lat2 = 56.834340;

$lng1 = 60.633386;
$lng2 = 60.622657;

$gitCalculator = new \GisCalculator\GisCalculator();

$pointA = \GisCalculator\GisCalculator::makePoint($lat1, $lng1);
$pointB = \GisCalculator\GisCalculator::makePoint($lat2, $lng2);

printf(sprintf("Value: %s\n", $gitCalculator->getDistance($pointA, $pointB)));


