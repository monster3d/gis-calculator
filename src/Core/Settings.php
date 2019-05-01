<?php

namespace GisCalculator\Core;

/**
 * Class Settings
 * @package GisCalculator\Core
 */
class Settings implements SettingsInterface
{
    /**
     * @var array
     */
    private $settingContainer = [];

    /**
     * @param string $key
     * @return null|string
     */
    public function getValue(string $key): ?string
    {
        $result = null;

        if (array_key_exists($key, $this->settingContainer)) {
            $result = $this->settingContainer[$key];
        }

        return $result;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setValue(string $key, string $value)
    {
        $this->settingContainer[$key] = $value;
    }
}