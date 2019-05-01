# gis-calculator
[![Build Status](https://travis-ci.com/monster3d/gis-calculator.svg?branch=master)](https://travis-ci.com/monster3d/gis-calculator)
## Description
Simple gis data calculation

## Feature
### Distance modules:
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

## Contribution
....

