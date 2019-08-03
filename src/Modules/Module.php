<?php

namespace GisCalculator\Modules;

use GisCalculator\Core\ModuleInterface;
use GisCalculator\Core\SettingsInterface;

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
     * @var string
     */
    protected $description;

    /**
     * @var SettingsInterface
     */
    protected $settings;

    /**
     * Distance constructor.
     * @param SettingsInterface $settings
     */
    public function __construct(SettingsInterface $settings)
    {
        $this->settings = $settings;
    }

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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return SettingsInterface
     */
    public function &getSetting(): SettingsInterface
    {
        return $this->settings;
    }
}