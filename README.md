# Savvy API SDK for PHP 

[![Build Status](https://github.com/savvy-software/savvy-php/actions/workflows/tests.yml/badge.svg)](https://github.com/savvy-software/savvy-php)

This library helps with integrating Savvy into PHP applications.

## Installation

This library can be installed via [Composer](https://getcomposer.org):

```bash
composer require savvy-software/savvy-php
```

## Configuration

The only required configuration is the Environment Token. You can get your Environment Token via the [Project settings](https://app.havesavvy.com/admin/projects) in your Savvy account.

Configuration values can be set when creating a new API client or via environment variables. The environment takes precedence over values provided during the initialization process.

**Configuration via environment variables**

```bash
SAVVY_ENVIRONMENT_TOKEN=tok-sample
```

**Configuration during initialization**

```php
$client = new \Savvy\Client(['environment_token' => 'tok-sample']);
```

## Context

When retrieving values for settings a context can be provided that can change the value based on unique attributes of the context.

```php
$context = new \Savvy\Settings\Entities\Context\Context('user', 'John Doe', 'john-doe'[
    new \Savvy\Settings\Entities\Context\Attribute('key', [
        new \Savvy\Settings\Entities\Context\Value('value'),
    ]),
]);

$client = new \Savvy\Client([
    'environment_token' => 'tok-sample-token',
    'context' => $context,
]);
```

## Usage

Before retrieving a setting or flag, create a new client. If you configured your environment token key via environment variables there's nothing to add. Otherwise, see the example above.

```php
$client = new \Savvy\Client();
```

### Retrieving Settings

#### All settings

```php
$results = $client->settings();

foreach ($results as $result)
{
    $key = $result->key;
    $name = $result->name;
    $type = $result->type;
    $value = $result->value
}
```

#### Single setting

```php
$result = $client->setting('setting-key');

$key = $result->key;
$name = $result->name;
$type = $result->type;
$value = $result->value
```

## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/savvy-software/savvy-php. This project is intended to be a safe, welcoming space for collaboration, and contributors are expected to adhere to the [Contributor Covenant](http://contributor-covenant.org) code of conduct.

## License

The library is available as open source under the terms of the [MIT License](http://opensource.org/licenses/MIT).

## Code of Conduct

Everyone interacting in the Savvy Software’s code bases, issue trackers, chat rooms and mailing lists is expected to follow the [code of conduct](https://github.com/savvy-software/savvy-php/blob/master/CODE_OF_CONDUCT.md).

## What is Savvy?

[Savvy](https://havesavvy.com/) allows you to control which features and settings are enabled in your application giving you better flexibility to deploy code and release features.

Savvy Software was started in 2023 as an alternative to highly complex feature flag tools. Learn more [about us](https://havesavvy.com/).
