<?php

namespace GisCalculator;

use GisCalculator\Core\Settings;
use GisCalculator\Element\Point;
use GisCalculator\Modules\Module;
use GisCalculator\Modules\Distance;

final class GisCalculator
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
        return $this->modules['distance']->get($from, $to);
    }

    /**
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
     * @param $latitude
     * @param $longitude
     * @return Point
     */
    public static function makePoint($latitude, $longitude) : Point
    {
        return new Point((float) $latitude, (float) $longitude);
    }

    /**
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