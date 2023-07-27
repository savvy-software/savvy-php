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

    public function setting($key)
    {
        return $this->settings->single($key);
    }

    public function settings()
    {
        return $this->settings->all();
    }
}