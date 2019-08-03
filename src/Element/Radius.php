<?php

namespace GisCalculator\Element;

/**
 * Class Radius
 * @package GisCalculator\Element
 */
class Radius
{
    /**
     * @var int
     */
    private $value;

    /**
     * @var string
     */
    private $metric;

    public function __construct(int $value, string $metric)
    {
        $this->value  = $value;
        $this->metric = $metric;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getMetric(): string
    {
        return $this->metric;
    }
}