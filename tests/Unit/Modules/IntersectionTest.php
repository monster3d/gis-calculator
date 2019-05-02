<?php

namespace Tests\Unit\Modules;

use GisCalculator\Core\Settings;
use GisCalculator\Element\Point;
use GisCalculator\Modules\Intersection;
use PHPUnit\Framework\TestCase;

/**
 * Class IntersectionTest
 * @package Tests\Unit\Modules
 */
class IntersectionTest extends TestCase
{

    /**
     * @todo Replace settings to mock object
     * @return Intersection
     */
    private function makeIntersection() : Intersection
    {
        return new Intersection(new Settings());
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
    public function test_get_findIntersectionOfLines_foundIntersect_returnIntersectPoint()
    {
        //Arrange
        $intersectModule = $this->makeIntersection();
        $pointA1 = $this->makePoint(56.841919, 60.610369);
        $pointA2 = $this->makePoint(56.817216, 60.606771);
        $pointB1 = $this->makePoint(56.831107, 60.567193);
        $pointB2 = $this->makePoint(56.839423, 60.663087);
        $intersectPoint = $this->makePoint(56.834760841253, 60.609326411846);

        //Act
        $intersect = $intersectModule->get($pointA1, $pointA2, $pointB1, $pointB2);

        //Assert
        $this->assertEquals($intersectPoint, $intersect);
    }

    /**
     * @group unit
     */
    public function test_get_findIntersectionOfLines_notFoundIntersect_returnNull()
    {
        //Arrange
        $intersectModule = $this->makeIntersection();
        $pointA1 = $this->makePoint(56.848096, 60.553014);
        $pointA2 = $this->makePoint(56.811283, 60.552348);
        $pointB1 = $this->makePoint(56.855400, 60.651259);
        $pointB2 = $this->makePoint(56.816036, 60.670742);

        //Act
        $intersect = $intersectModule->get($pointA1, $pointA2, $pointB1, $pointB2);


        //Assert
        $this->assertNull($intersect);
    }
}