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
     * @param $mockSettings
     * @return Distance
     */
    private function makeDistance($mockSettings) : Distance
    {
        return new Distance($mockSettings);
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
        $mockBuilder = $this
            ->getMockBuilder(Settings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getValue'])
            ->getMock();

        $mockBuilder
            ->expects($this->any())
            ->method('getValue')
            ->willReturn(null);

        $distanceModule = $this->makeDistance($mockBuilder);
        $pointA = $this->makePoint(56.836341, 60.621788);
        $pointB = $this->makePoint(56.827314, 60.625178);

        //Act
        $distance = $distanceModule->get($pointA, $pointB);

        //Assert
        $this->assertEquals(1025.89, $distance);
    }

    /**
     * @group unit
     */
    public function test_get_calculateDistanceBetweenPoints_roundResult_returnCorrectRoundDistance()
    {
        //Arrange
        $mockBuilder = $this
            ->getMockBuilder(Settings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getValue'])
            ->getMock();

        $mockBuilder
            ->expects($this->any())
            ->method('getValue')
            ->willReturn(5);

        $distanceModule = $this->makeDistance($mockBuilder);
        $pointA = $this->makePoint(56.836341, 60.621788);
        $pointB = $this->makePoint(56.827314, 60.625178);

        //Act
        $distance = $distanceModule->get($pointA, $pointB);

        //Assert
        $this->assertEquals(1025.88857, $distance);
    }

    /**
     * @group unit
     */
    public function test_get_calculateDistanceBetweenPoints_metricAsCentimeters_returnCorrectDistance()
    {
        //Arrange
        $mockBuilder = $this
            ->getMockBuilder(Settings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getValue'])
            ->getMock();

        $mockBuilder
            ->expects($this->any())
            ->method('getValue')
            ->willReturn('centimeters');

        $distanceModule = $this->makeDistance($mockBuilder);
        $pointA = $this->makePoint(56.836341, 60.621788);
        $pointB = $this->makePoint(56.827314, 60.625178);

        //Act
        $distance = $distanceModule->get($pointA, $pointB);

        //Assert
        $this->assertEquals(102600.0, $distance);
    }

    /**
     * @group unit
     */
    public function test_get_calculateDistanceBetweenPoints_metricAsKilometers_returnCorrectDistance()
    {
        //Arrange
        $mockBuilder = $this
            ->getMockBuilder(Settings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getValue'])
            ->getMock();

        $mockBuilder
            ->expects($this->any())
            ->method('getValue')
            ->willReturn('kilometers');

        $distanceModule = $this->makeDistance($mockBuilder);
        $pointA = $this->makePoint(56.836341, 60.621788);
        $pointB = $this->makePoint(56.827314, 60.625178);

        //Act
        $distance = $distanceModule->get($pointA, $pointB);

        //Assert
        $this->assertEquals(1.026, $distance);
    }

    /**
     * @group unit
     */
    public function test_prepareResult_calculateDistanceBetweenPoints_spy_returnCorrectDistance()
    {
        //Arrange
        $mockBuilder = $this
            ->getMockBuilder(Settings::class)
            ->disableOriginalConstructor()
            ->setMethods(['getValue'])
            ->getMock();

        $mockBuilder
            ->expects($this->at(0))
            ->method('getValue')
            ->with($this->stringContains('round'));

        $mockBuilder
            ->expects($this->at(1))
            ->method('getValue')
            ->with($this->stringContains('metric'));

        $distanceModule = $this->makeDistance($mockBuilder);
        $pointA = $this->makePoint(56.836341, 60.621788);
        $pointB = $this->makePoint(56.827314, 60.625178);

        //Act
        $distance = $distanceModule->get($pointA, $pointB);

        //Assert
        $this->assertNotEmpty($distance);
    }
}