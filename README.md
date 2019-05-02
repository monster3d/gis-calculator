# gis-calculator
[![Build Status](https://travis-ci.com/monster3d/gis-calculator.svg?branch=master)](https://travis-ci.com/monster3d/gis-calculator)
[![codecov](https://codecov.io/gh/monster3d/gis-calculator/branch/master/graph/badge.svg)](https://codecov.io/gh/monster3d/gis-calculator)
## Description
Simple gis data calculation

## Feature
### Distance:
Distance module add ability calculation distance between two points

#### Use 
** ** 
```php
<?php

// include a autoloader
include "vendor/autoload.php";

// Use main facade
$gitCalculator = new \GisCalculator\GisCalculator();

// Use simple point builder
$pointA = \GisCalculator\GisCalculator::makePoint(56.836341, 60.621788);
$pointB = \GisCalculator\GisCalculator::makePoint(56.827314, 60.625178);

$distance = $gitCalculator->getDistance($pointA, $pointB);
//** $distance float 750.8 */

```
<b>Warning: </b> metric system uses meters as default

#### Settings

If need change default settings this module 

Go way:
```php
    // Use main facade
    $gitCalculator = new \GisCalculator\GisCalculator();
    
    // Call target module by name
    $distance = $gitCalculator->getModules('distance');
    
    if (null !== $distance) {
        //Get private setting manager
        $setting = $distance->getSetting();
        //Add setting key 'round' value 3
        $setting->setValue(\GisCalculator\Core\SettingsKeys::ROUND, 3);
    }
```
#### Support settings
* Round `SettingsKeys::ROUND` set integer value 1,2,3...n   
* Metric `SettingsKeys::METRIC` set value from select `Metric::CENTIMETERS` or `Metric::KILOMETERS`

### Gis With:
Gis modules with the ability to quickly find the desired points in the circle along the radius
#### Use
** **
```php
    // Use main facade
    $gitCalculator = new \GisCalculator\GisCalculator();
    // Create center point
    $center = \GisCalculator\GisCalculator::makePoint(56.830794, 60.636087);
    // Create search point
    $point = \GisCalculator\GisCalculator::makePoint(56.830160, 60.630271);
    // Create need search radius = 10 km
    $radius = \GisCalculator\GisCalculator::makeRadius(10, \GisCalculator\Core\Metric::KILOMETERS);
    // Search point it radius
    $search = $gitCalculator->gisWithPointInRadius($center, $point, $radius);
    
    if ($search) {
        print_r('Ok, point enters radius');
    }
    
    // Can aslo use collection
    $center = \GisCalculator\GisCalculator::makePoint(56.830794, 60.636087);
    $point1 = \GisCalculator\GisCalculator::makePoint(56.830160, 60.630271);
    $point2 = \GisCalculator\GisCalculator::makePoint(56.826579, 60.637781);
    $point3 = \GisCalculator\GisCalculator::makePoint(56.662034, 60.434503);
    
    // Create collection
    $pointCollection = new \GisCalculator\Element\CollectionPoints();
    $pointCollection
        ->setPoint($point1)
        ->setPoint($point2)
        ->setPoint($point3);
    
    // Radius can use any metrict km, cm and etc...
    $radius = \GisCalculator\GisCalculator::makeRadius(10, \GisCalculator\Core\Metric::KILOMETERS);
    
    $searchPoints = $gitCalculator->gisWithCollectionInRadius($center, $radius, $pointCollection);
    
    foreach($searchPoints as $point) {
        // Give all points that were found in radius
    }

```
## Require this package with Composer

Install this package through Composer. Edit your project's composer.json file to require monster3d/gis-calculator

composer.json

```json
{
    "name": "yourproject/yourproject",
    "type": "project",
    "require": {
        "monster3d/gis-calculator": "*"
    }
}
```

Or command line

```bash
composer require monster3d/gis-calculator
```

## Contribution
....

