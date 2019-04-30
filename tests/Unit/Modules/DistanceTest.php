<?php

namespace Tests\Unit\Modules;


use GisCalculator\Core\Settings;
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
    private function makeDistace() : Distance
    {
        $defaultSettings = new Settings();

        return new Distance($defaultSettings);
    }


    /**
     * @group unit
     */
    public function test_get_calculateDistanceBetweenPoints_returnCorrectDistance()
    {
        $this->assertTrue(true);

    }

}