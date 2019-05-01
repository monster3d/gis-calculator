<?php

namespace Tests\Unit\Core;

use GisCalculator\Core\Settings;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

/**
 * Class SettingsTest
 * @package Tests\Unit\Core
 */
class SettingsTest extends TestCase
{
    /**
     * @return Settings
     */
    private function makeSettings() : Settings
    {
        return new Settings();
    }

    /**
     * @group unit
     */
    public function test_getValue_foundValue_returnValue()
    {
        //Arrange
        $settings = $this->makeSettings();
        try {
            $reflectionClass = new ReflectionClass($settings);
            $property = $reflectionClass->getProperty('settingContainer');
            $property->setAccessible(true);
            $property->setValue($settings, ['test_key' => 'test_value']);
        } catch (ReflectionException $e) {
            $this->markTestSkipped($e->getMessage());
        }

        //Act
        $value = $settings->getValue('test_key');

        //Assert
        $this->assertEquals('test_value', $value);
    }

    /**
     * @group unit
     */
    public function test_setValue_getValue_foundValue_returnValue()
    {
        //Arrange
        $settings = $this->makeSettings();

        //Act
        $settings->setValue('test_key', 'test_value');
        $value = $settings->getValue('test_key');

        //Assert
        $this->assertEquals('test_value', $value);
    }

    /**
     * @group unit
     */
    public function test_getValue_notFoundValue_returnNull()
    {
        //Arrange
        $settings = $this->makeSettings();

        //Act
        $value = $settings->getValue('test_key');

        //Assert
        $this->assertNull($value);
    }
}