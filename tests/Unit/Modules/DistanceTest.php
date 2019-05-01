<?php

namespace Tests\Unit\Modules;

use GisCalculator\Core\Settings;
use GisCalculator\Element\Point;
use GisCalculator\Modules\Distance;
use PHPUnit\Framework\TestCase;

/**
 * Class DistanceTest
 * @package Tests\Unit\Modules
 */
class DistanceTest extends TestCase
{

    /**
     * @return Distance
     */
    private function makeDistance() : Distance
    {
        $defaultSettings = new Settings();

        return new Distance($defaultSettings);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return Point
     */
    private function makePoint(float $latitude, float $longitude) : Point
    {
        return new Point($latitude, $longitude);
    }

    /**
     * @group unit
     */
    public function test_get_calculateDistanceBetweenPoints_returnCorrectDistance()
    {
        //Arrange
        $distanceModule = $this->makeDistance();
        $pointA = $this->makePoint(56.836341, 60.621788);
        $pointB = $this->makePoint(56.827314, 60.625178);

        //Act
        $distance = $distanceModule->get($pointA, $pointB);

        //Assert
        $this->assertEquals(1025.8885687402, $distance);
    }
}