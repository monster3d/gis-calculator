<?php

namespace GisCalculator\Modules;

use GisCalculator\Element\Point;

/**
 * Class Intersection
 * @package GisCalculator\Modules
 * Use formula a₁x + b₁y + c₁ = 0 | a₂x + b₂y + c₂ = 0
 */
class Intersection extends Module
{
    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * @var string
     */
    protected $name = 'Intersection';

    /**
     * @todo need optimization this method
     * @param Point $pointA1
     * @param Point $pointA2
     * @param Point $pointB1
     * @param Point $pointB2
     * @return Point|null
     */
    public function get(Point $pointA1, Point $pointA2, Point $pointB1, Point $pointB2): ?Point
    {
        $a1 = $pointA1->getLongitude() - $pointA2->getLongitude();
        $b1 = $pointA2->getLatitude() - $pointA1->getLatitude();
        $c1 = $pointA1->getLatitude() * $pointA2->getLongitude() - $pointA2->getLatitude() * $pointA1->getLongitude();
        $a2 = $pointB1->getLongitude() - $pointB2->getLongitude();
        $b2 = $pointB2->getLatitude() - $pointB1->getLatitude();
        $c2 = $pointB1->getLatitude() * $pointB2->getLongitude() - $pointB2->getLatitude() * $pointB1->getLongitude();

        if (0 === $b2) {

            if (0 === $b1) {
                return null;
            }

            $latitude = $pointB1->getLatitude();
            $longitude = (-1) * ($a1 * $latitude + $c1) / $b1;
        } elseif (0 === $b1) {

            if (0 === $b2) {
                return null;
            }

            $latitude = $pointA1->getLatitude();
            $longitude =  (-1) * ($a2 * $latitude + $c2) / $b2;

        } elseif (0 === ($a1 * $b2 - $a2 * $b1)) {
            $latitude = 0.0;
            $longitude = 0.0;

            return new Point($latitude, $longitude);
        } else {
            $latitude = ($c2 * $b1 - $c1 * $b2) / ($a1 * $b2 - $a2 * $b1);
            $longitude = (-1) * ($a2 * $latitude + $c2) / $b2;
        }

        if (
            ($latitude >= $pointA1->getLatitude() && $latitude <= $pointA2->getLatitude())
                                                  ||
            ($latitude >= $pointA2->getLatitude() && $latitude <= $pointA1->getLatitude())
        ) {
            if (
                ($longitude >= $pointA1->getLongitude() && $longitude <= $pointA2->getLongitude())
                                                        ||
                ($longitude >= $pointA2->getLongitude() && $longitude <= $pointA1->getLongitude())
            ) {
                if (
                    ($latitude >= $pointB1->getLatitude() && $latitude <= $pointB2->getLatitude())
                                                          ||
                    ($latitude >= $pointB2->getLatitude() && $latitude <= $pointB1->getLatitude())
                ){
                    if (
                        ($longitude >= $pointB1->getLongitude() && $longitude <= $pointB2->getLongitude())
                                                                ||
                        ($longitude >= $pointB2->getLongitude() && $longitude <= $pointB1->getLongitude())
                    ) {
                        return new Point($latitude, $longitude);
                    }
                }
            }
        }

        return null;
    }
}