<?php

include "vendor/autoload.php";

$lat1 = 56.836341;
$lat2 = 56.827314;

$lng1 = 60.621788;
$lng2 = 60.625178;

$gitCalculator = new \GisCalculator\GisCalculator();

$pointA = \GisCalculator\GisCalculator::makePoint($lat1, $lng1);
$pointB = \GisCalculator\GisCalculator::makePoint($lat2, $lng2);

printf(sprintf("Value: %s\n", $gitCalculator->getDistance($pointA, $pointB)));


