<?php

namespace GisCalculator\Modules;

use GisCalculator\Core\ModuleInterface;

/**
 * Class Module
 * @package GisCalculator\Modules
 */
class Module implements ModuleInterface
{
    /**
     * Module name
     * @var string
     */
    protected $name;

    /**
     * Version module
     * @var string
     */
    protected $version;

    /**
     * Module name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Version module
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }
}