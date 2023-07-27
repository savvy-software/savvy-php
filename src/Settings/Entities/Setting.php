<?php

namespace Savvy\Settings\Entities;

class Setting
{
    static public function map(string $json) : Setting
    {
        $source = json_decode($json)->data->setting;
        return new Setting($source->key, $source->name, $source->type, $source->value->boolean);
    }

    public string $key;
    public string $name;
    public string $type;
    public bool $value;

    function __construct(string $key, string $name, string $type, bool $value) {
        $this->key = $key;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }
}