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
}