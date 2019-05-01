<?php

namespace GisCalculator\Core;

/**
 * Interface SettingsInterface
 * @package GisCalculator\Core
 */
interface SettingsInterface
{
    /**
     * @param string $key
     * @return null|string
     */
    public function getValue(string $key) : ?string;

    /**
     * @param string $key
     * @param string $value
     * @return SettingsInterface
     */
    public function setValue(string $key, string $value) : self;
}