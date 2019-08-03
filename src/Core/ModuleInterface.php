<?php

namespace GisCalculator\Core;

interface ModuleInterface
{
    /**
     * Module name
     * @return string
     */
    public function getName(): string;

    /**
     * Version module
     * @return string
     */
    public function getVersion(): string;
}