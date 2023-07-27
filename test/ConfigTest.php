<?php
namespace Savvy\Test;

use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    public function tearDown(): void
    {
        putenv("SAVVY_API_ENDPOINT=");
        putenv("SAVVY_ENVIRONMENT_TOKEN=");
    }

    public function testConfigFromArray()
    {
        $config = new \Savvy\Config(['key' => 'value']);
        $this->assertEquals('value', $config->get('key'));
    }

    public function testConfigFromNull()
    {
        $config = new \Savvy\Config(null);
        $this->assertEquals('https://api.havesavvy.com/', $config->get('api_endpoint'));
    }

    public function testConfigFromConfig()
    {
        $other = new \Savvy\Config(['key' => 'value']);
        $config = new \Savvy\Config($other);
        $this->assertEquals('value', $config->get('key'));
    }

    public function testAPIEndpointDefaultValue()
    {
        $config = new \Savvy\Config();
        $this->assertEquals('https://api.havesavvy.com/', $config->get('api_endpoint'));
    }

    public function testAPIEndpointFromEnvironment()
    {
        putenv("SAVVY_API_ENDPOINT=http://example.com");

        $config = new \Savvy\Config();
        $this->assertEquals('http://example.com', $config->get('api_endpoint'));
    }

    public function testAPIEndpointFromConstructor()
    {
        $config = new \Savvy\Config(['api_endpoint' => 'http://localhost']);
        $this->assertEquals('http://localhost', $config->get('api_endpoint'));
    }

    public function testEnvironmentTokenDefaultValue()
    {
        $config = new \Savvy\Config();
        $this->assertEquals('', $config->get('environment_token'));
    }

    public function testEnvironmentTokenFromEnvironment()
    {
        putenv("SAVVY_ENVIRONMENT_TOKEN=tok-environment");

        $config = new \Savvy\Config();
        $this->assertEquals('tok-environment', $config->get('environment_token'));
    }

    public function testEnvironmentTokenFromConstructor()
    {
        $config = new \Savvy\Config(['environment_token' => 'tok-constructor']);
        $this->assertEquals('tok-constructor', $config->get('environment_token'));
    }
}