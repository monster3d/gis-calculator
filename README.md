# gis-calculator
[![Build Status](https://travis-ci.com/monster3d/gis-calculator.svg?branch=master)](https://travis-ci.com/monster3d/gis-calculator)
## Description
Simple gis data calculation

### Feature
#### Distance modules:
Distance module add ability calculation distance between two points

Use:
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
<b>Warning: </b> metric system uses meters only

Todo: 
* Round
* Metric cm, m, km

## Contribution
....

