<?php

namespace GisCalculator;

use GisCalculator\Core\Metric;
use GisCalculator\Core\Settings;
use GisCalculator\Core\SettingsKeys;
use GisCalculator\Element\CollectionPoints;
use GisCalculator\Element\Point;
use GisCalculator\Element\Radius;
use GisCalculator\Modules\Intersection;
use GisCalculator\Modules\Module;
use GisCalculator\Modules\Distance;

/**
 * Class GisCalculator
 * @package GisCalculator
 */
final class GisCalculator
{
    /**
     * @var array
     */
    private $modules = [];

    /**
     * GisCalculator constructor.
     */
    public function __construct()
    {
        $defaultDistanceSettings = new Settings();
        $defaultIntersectionSettings = new Settings();

        $distanceModule  = new Distance($defaultDistanceSettings);
        $intersectionModule = new Intersection($defaultIntersectionSettings);

        $this->registerModule($distanceModule);
        $this->registerModule($intersectionModule);
    }

    /**
     * @param Point $from
     * @param Point $to
     * @return float
     */
    public function getDistance(Point $from, Point $to) : float
    {
        return $this->modules['distance']->get($from, $to);
    }


    /**
     * @param Point $center
     * @param Radius $radius
     * @param CollectionPoints $collectionPoints
     * @return array
     */
    public function gisWithCollectionInRadius(Point $center, Radius $radius, CollectionPoints $collectionPoints) : array
    {
        $result = [];

        foreach ($collectionPoints->getIterator() as $point) {
            if ($this->gisWithPointInRadius($center, $point, $radius)) {
                $result[] = $point;
            }
        }

        return $result;
    }

    /**
     * @param Point $center
     * @param Point $point
     * @param Radius $radius
     * @return bool
     */
    public function gisWithPointInRadius(Point $center, Point $point, Radius $radius) : bool
    {
        $result = false;
        $distanceSettings = $this
            ->getModule('distance')
            ->getSetting();

        switch ($radius->getMetric()) {
            case Metric::KILOMETERS:
                $distanceSettings->setValue(SettingsKeys::METRIC, Metric::KILOMETERS);
                break;
            case Metric::CENTIMETERS:
                $distanceSettings->setValue(SettingsKeys::METRIC, Metric::CENTIMETERS);
                break;
            default:
                $distanceSettings->setValue(SettingsKeys::METRIC, Metric::KILOMETERS);
                break;
        }

        $distance = $this->modules['distance']->get($center, $point);

        if ($distance <= $radius->getValue()) {
            $result = true;
        }

        return $result;
    }

    /**
     * @param Point $pointA1
     * @param Point $pointA2
     * @param Point $pointB1
     * @param Point $pointB2
     * @return Point|null
     */
    public function findGisPointIntersection(Point $pointA1, Point $pointA2, Point $pointB1, Point $pointB2) : ?Point
    {
        return $this->modules['intersection']->get($pointA1, $pointA2, $pointB1, $pointB2);
    }

    /**
     * Get module by name
     *
     * @param string $name
     * @return Module|null
     */
    public function &getModule(string $name) : ?Module
    {
        $result = null;
        if (array_key_exists($name, $this->modules)) {
            $result = $this->modules[$name];
        }

        return $result;
    }

    /**
     * @param Module $module
     */
    private function registerModule(Module $module) : void
    {
        $moduleName = $module->getName();
        $this->modules[strtolower($moduleName)] = $module;
    }

    /**
     * Build point
     *
     * @param $latitude
     * @param $longitude
     * @return Point
     */
    public static function makePoint($latitude, $longitude) : Point
    {
        return new Point((float) $latitude, (float) $longitude);
    }

    /**
     * Build radius
     *
     * @param int $radius
     * @param string $metric
     * @return Radius
     */
    public static function makeRadius(int $radius, $metric = Metric::KILOMETERS) : Radius
    {
        return new Radius($radius, $metric);
    }

    /**
     * Get all registered modules
     * @return array
     */
    public function getModulesInfo() : array
    {
        $result = [];

        /** @var Module $module */
        foreach ($this->modules as $module) {
            $info = [
                'name'        => $module->getName(),
                'version'     => $module->getVersion(),
                'description' => $module->getDescription(),
            ];

            $result[] = $info;
        }

        return $result;
    }
}