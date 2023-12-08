<?php
namespace Savvy\Settings;

use \Savvy\Settings\Entities\Setting;

class Settings
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function all() : array
    {
        $endpoint = '/settings';
        $result = $this->client->get($endpoint);
        $source = json_decode($result);
        
        return array_map(fn($item) : Setting => new Setting($item->setting->key, $item->setting->name, $item->setting->type, $item->setting->value), $source->data);
    }

    public function single($key) : Setting
    {
        $endpoint = '/settings/' . $key;
        $result = Setting::map($this->client->get($endpoint));

        return $result;
    }
}