<?php

namespace Tests\Integration;

use GisCalculator\Core\Metric;
use GisCalculator\Element\CollectionPoints;
use GisCalculator\Element\Point;
use GisCalculator\Element\Radius;
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

   private function makePoint(float $latitude, float $longitude) : Point
   {
       return new Point($latitude, $longitude);
   }

    /**
     * @param int $value
     * @param string $metric
     * @return Radius
     */
   private function makeRadius(int $value, string $metric) : Radius
   {
       return new Radius($value, $metric);
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

    /**
     * @group integration
     */
   public function test_gisWithPointInRadius_foundPoint_returnTrue()
   {
       //Arrange
       $gisCalculator = $this->makeGisCalculator();
       $center = $this->makePoint(56.830794, 60.636087);
       $point  = $this->makePoint(56.830160, 60.630271);
       $radius = $this->makeRadius(5, Metric::KILOMETERS);

       //Act
       $result = $gisCalculator->gisWithPointInRadius($center, $point, $radius);

       //Assert
       $this->assertTrue($result);
   }

    /**
     * @group integration
     */
    public function test_gisWithPointInRadius_notFoundPoint_returnFalse()
    {
        //Arrange
        $gisCalculator = $this->makeGisCalculator();
        $center = $this->makePoint(56.830794, 60.636087);
        $point  = $this->makePoint(56.662034, 60.434503);
        $radius = $this->makeRadius(5, Metric::KILOMETERS);

        //Act
        $result = $gisCalculator->gisWithPointInRadius($center, $point, $radius);

        //Assert
        $this->assertFalse($result);
    }

    /**
     * @group integration
     */
    public function test_gisWithCollectionInRadius_foundPoints_returnArrayPoints()
    {
        //Arrange
        $gisCalculator = $this->makeGisCalculator();
        $center = $this->makePoint(56.830794, 60.636087);
        $point1 = $this->makePoint(56.830160, 60.630271);
        $point2 = $this->makePoint(56.826579, 60.637781);
        $collectionPoint = new CollectionPoints();
        $collectionPoint
            ->setPoint($point1)
            ->setPoint($point2);
        $radius = $this->makeRadius(5, Metric::KILOMETERS);

        //Act
        $result = $gisCalculator->gisWithCollectionInRadius($center, $radius, $collectionPoint);

        //Assert
        $this->assertEquals($point1, $result[0]);
        $this->assertEquals($point2, $result[1]);
    }

    /**
     * @group integration
     */
    public function test_gisWithCollectionInRadius_notFoundPoints_returnArrayAsEmpty()
    {
        //Arrange
        $gisCalculator = $this->makeGisCalculator();
        $center = $this->makePoint(56.830794, 60.636087);
        $point1 = $this->makePoint(56.662034, 60.434503);
        $point2 = $this->makePoint(56.662035, 60.434506);
        $collectionPoint = new CollectionPoints();
        $collectionPoint
            ->setPoint($point1)
            ->setPoint($point2);
        $radius = $this->makeRadius(5, Metric::KILOMETERS);

        //Act
        $result = $gisCalculator->gisWithCollectionInRadius($center, $radius, $collectionPoint);

        //Assert
        $this->assertEmpty($result);
    }

    /**
     * @group integration
     */
    public function test_findGisPointIntersection_fountIntersect_returnIntersectPoint()
    {
        //Arrange
        $gisCalculator = $this->makeGisCalculator();
        $pointA1 = $this->makePoint(56.841919, 60.610369);
        $pointA2 = $this->makePoint(56.817216, 60.606771);
        $pointB1 = $this->makePoint(56.831107, 60.567193);
        $pointB2 = $this->makePoint(56.839423, 60.663087);
        $intersectPoint = $this->makePoint(56.834760841253, 60.609326411846);

        //Act
        $intersect = $gisCalculator->findGisPointIntersection($pointA1, $pointA2, $pointB1, $pointB2);

        //Assert
        $this->assertEquals($intersectPoint, $intersect);
    }

    /**
     * @group integration
     */
    public function test_findGisPointIntersection_notFountIntersect_returnNull()
    {
        //Arrange
        $gisCalculator = $this->makeGisCalculator();
        $pointA1 = $this->makePoint(56.848096, 60.553014);
        $pointA2 = $this->makePoint(56.811283, 60.552348);
        $pointB1 = $this->makePoint(56.855400, 60.651259);
        $pointB2 = $this->makePoint(56.816036, 60.670742);

        //Act
        $intersect = $gisCalculator->findGisPointIntersection($pointA1, $pointA2, $pointB1, $pointB2);

        //Assert
        $this->assertNull($intersect);
    }
}