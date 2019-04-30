<?php

namespace GisCalculator;

use GisCalculator\Core\Distance;
use GisCalculator\Core\Settings;
use GisCalculator\Element\Point;
use GisCalculator\Modules\Module;

class GisCalculator
{
    /**
     * @var array
     */
    private $modules = [];

    public function __construct()
    {
        $defaultSettings = new Settings();
        $distanceModule  = new Distance($defaultSettings);

        $this->registerModule($distanceModule);
    }

    /**
     * @param Point $from
     * @param Point $to
     * @return float
     */
    public function getDistance(Point $from, Point $to) : float
    {
        return $this->modules['Distance']->get($from, $to);
    }

    /**
     * @param Module $module
     */
    private function registerModule(Module $module) : void
    {
        $moduleName = $module->getName();
        $this->modules[$moduleName] = $module;
    }

    /**
     * @param $latitude
     * @param $longitude
     * @return Point
     */
    public static function makePoint($latitude, $longitude) : Point
    {
        return new Point((float) $latitude, (float) $longitude);
    }
}