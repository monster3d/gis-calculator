<?php

namespace GisCalculator\Element;

/**
 * Class Point
 * @package GisCalculator\Element
 */
class Point
{
    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * Point constructor.
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;

    }

    /**
     * @return float
     */
    public function getLatitude() : float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude() : float
    {
        return $this->longitude;
    }
}