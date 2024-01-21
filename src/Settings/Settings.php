<?php
namespace Savvy\Settings;

use Exception;
use \Savvy\Exceptions\InvalidTokenException;
use \Savvy\Exceptions\NoResponseException;
use \Savvy\Exceptions\SettingNotFoundException;
use \Savvy\Settings\Request\Entities\DefaultValue;
use \Savvy\Settings\Response\Entities\Setting;

class Settings {
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    public function all(array $defaultValues = null) : array {
        $endpoint = '/settings';

        $defaults = null;
        if ($defaultValues != null) {
            $defaults = json_encode(array_map(fn($value): array => $value->toArray(), $defaultValues));
        }

        try {
            return json_decode($this->client->get($endpoint, $defaults != null ? ['x-default-value' => $defaults] : null), true);
            // return array_map(fn($value): Setting => new Setting($value['key'], '', $value['type'], (object)array($value['type'] => $value['value'])), $results);
        } catch (InvalidTokenException $e) {
            throw $e;
        } catch (Exception) {
            if ($defaultValues != null) {
                return array_map(fn($value): Setting => new Setting($value->key, '', $value->type, (object)array($value->type => $value->value)), $defaultValues);
            }
            
            throw new NoResponseException();
        }
    }

    public function single(string $key, string $type, string|bool|int|float $defaultValue = null) : Setting {
        $default = null;
        if ($defaultValue != null) {
            $default = new DefaultValue($key, $type, $defaultValue);
        }

        $endpoint = "/settings/$key";

        try {
            $result = Setting::map($this->client->get($endpoint, $default != null ? ['x-default-value' => $default->toJson()] : null));
            return $result;
        } catch (InvalidTokenException|SettingNotFoundException $e) {
            throw $e;
        } catch (Exception) {
            if ($defaultValue != null) {
                return new Setting($key, '', $type, (object)array($type => $defaultValue));
            }
            
            throw new NoResponseException();
        }
    }
}