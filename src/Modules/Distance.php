<?php

namespace GisCalculator\Modules;

use GisCalculator\Core\SettingsInterface;
use \GisCalculator\Element\Point;;

class Distance extends Module
{
    /**
     * Module name
     * @var string
     */
    protected $name = 'Distance';

    /**
     * Current version
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * @var SettingsInterface
     */
    private $settings;

    /**
     * Distance constructor.
     * @param SettingsInterface $settings
     */
    public function __construct(SettingsInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * This Krasovsky's ellipsoid constant
     */
    private const ELLIPSOID = 6378245;

    /**
     * @param Point $from
     * @param Point $to
     * @return float
     */
    public function get(Point $from, Point $to) : float
    {
        $angle = function(float $from, float $to) {
            $difference = ($from - $to) / 2;
            return pow(sin(deg2rad($difference)), 2);
        };

        $x = $angle($from->getLatitude(), $to->getLatitude());
        $y = $angle($from->getLongitude(), $to->getLongitude());

        $circle = ($x + cos(deg2rad($from->getLatitude())) * cos(deg2rad($to->getLatitude())) * $y);
        $distance = acos(sqrt($circle)) * self::ELLIPSOID;


        return $this->prepareResult($distance);
    }

    /**
     * @param float $result
     * @return float
     */
    private function prepareResult(float $result) : float {
        return $result;
    }
}