<?php
namespace Savvy;

use \Savvy\Settings\Settings;
use \Savvy\Shared\HttpClient;

class Client
{
    public $settings;

    public function __construct($config = null)
    {
        $config = new Config($config);
        $client = new HttpClient($config);

        $this->settings = new Settings($client);
    }

    public function setting(string $key, string $type, string|bool|float|int $defaultValue) : \Savvy\Settings\Entities\Setting
    {
        return $this->settings->single($key, $type, $defaultValue);
    }
}