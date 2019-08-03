<?php

namespace GisCalculator\Element;

use Generator;

/**
 * Class CollectionPoints
 * @package GisCalculator\Element
 */
class CollectionPoints
{
    /**
     * @var Point[]
     */
    private $points = [];

    /**
     * @param Point $point
     * @return CollectionPoints
     */
    public function setPoint(Point $point) : self
    {
        $this->points[] = $point;

        return $this;
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return CollectionPoints
     */
    public function setCoordinate(float $latitude, float $longitude) : self
    {
        $point = new Point($latitude, $longitude);
        $this->points[] = $point;

        return $this;
    }

    /**
     * @param array $coordinate
     * @return CollectionPoints
     */
    public function setArrayCoordinate(array $coordinate): self
    {
        foreach ($coordinate as $arrayPoint) {
            $point = new Point($arrayPoint[0], $arrayPoint[1]);
            $this->points[] = $point;
        }

        return $this;
    }

    /**
     * @return Generator
     */
    public function getIterator(): Generator
    {
        yield from $this->points;
    }
}