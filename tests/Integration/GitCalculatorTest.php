<?php

namespace Tests\Integration;

use GisCalculator\Element\Point;
use GisCalculator\GisCalculator;
use PHPUnit\Framework\TestCase;

/**
 * Class GitCalculatorTest
 * @package Tests\Integration
 */
class GitCalculatorTest extends TestCase
{

    /**
     * @return GisCalculator
     */
   private function makeGisCalculator() : GisCalculator
   {
       return new GisCalculator();
   }

   private function makePoint(float $latitude, float $longitude)
   {
       return new Point($latitude, $longitude);
   }

    /**
     * @group integration
     */
   public function test_getDistance_betweenPoints_return_correctDistance()
   {
       //Arrange
       $gisCalculator = $this->makeGisCalculator();
       $pointA = $this->makePoint(56.836341, 60.621788);
       $pointB = $this->makePoint(56.827314, 60.625178);

       //Act
       $distance = $gisCalculator->getDistance($pointA, $pointB);

       //Assert
       $this->assertEquals(1025.89, $distance);
   }
}