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

$collection = new \GisCalculator\Element\CollectionPoints();
$collection->setPoint($pointA)->setPoint($pointB);

foreach ($collection->getIterator() as $p) {
    print_r($p->getLatitude() . PHP_EOL);
}

$pointCenter = \GisCalculator\GisCalculator::makePoint(56.830794, 60.636087);
$point1 = \GisCalculator\GisCalculator::makePoint(56.830160, 60.630271);
$point2 = \GisCalculator\GisCalculator::makePoint(56.826579, 60.637781);
$point3 = \GisCalculator\GisCalculator::makePoint(56.662034, 60.434503);

$pointCollection = new \GisCalculator\Element\CollectionPoints();
$pointCollection
    ->setPoint($point1)
    ->setPoint($point2)
    ->setPoint($point3);

$radius = \GisCalculator\GisCalculator::makeRadius(5000000, \GisCalculator\Core\Metric::CENTIMETERS);

$result = $gitCalculator->gisWithCollectionInRadius($pointCenter, $radius, $pointCollection);

print_r($result);

