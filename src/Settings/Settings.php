<?php
namespace Savvy\Settings;

use Exception;
use \Savvy\Exceptions\InvalidTokenException;
use \Savvy\Exceptions\SettingNotFoundException;
use \Savvy\Settings\Entities\Setting;

class Settings
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function single(string $key, string $type, string|bool|int|float $defaultValue = null) : Setting
    {
        $endpoint = "/settings/$key";

        try
        {
            $result = Setting::map($this->client->get($endpoint, $defaultValue != null ? ['x-default-value' => $defaultValue] : null));
            return $result;
        }
        catch (InvalidTokenException|SettingNotFoundException $e)
        {
            throw $e;
        }
        catch (Exception)
        {
            return new Setting($key, '', $type, (object)array($type => $defaultValue));
        }
    }
}