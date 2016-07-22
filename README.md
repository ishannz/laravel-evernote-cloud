## Installation

The Evernote cloud Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the
`ishannz/laravel-evernote-cloud` package and setting the `minimum-stability` to `dev` (required for Laravel 5) in your
project's `composer.json`.

```json
{
    "require": {
        "ishannz/laravel-evernote-cloud": "dev-master"
    },
    "minimum-stability": "dev"
}
```

or

Require this package with composer:
```
composer require ishannz/laravel-evernote-cloud
```
Update your `composer.json` file to include this package as a dependency

Update your packages with ```composer update``` or install with ```composer install```.

In Windows, you'll need to include the GD2 DLL `php_gd2.dll` as an extension in php.ini.


## Usage

To use the Evernote Cloud Service Provider, you must register the provider when bootstrapping your Laravel application. There are
essentially two ways to do this.

Find the `providers` key in `config/app.php` and register the Captcha Service Provider.

```php
    'providers' => [
        // ...
        'Ishannz\LaravelEvernote\LaravelEvernoteServiceProvider',
    ]
```
for Laravel 5.1+
```php
    'providers' => [
        // ...
        Ishannz\LaravelEvernote\LaravelEvernoteServiceProvider::class,
    ]
```

Find the `aliases` key in `config/app.php`.

```php
    'aliases' => [
        // ...
        'Evernote' => 'Ishannz\LaravelEvernote\Facades\Evernote',
    ]
```
for Laravel 5.1+
```php
    'aliases' => [
        // ...
        'Evernote' => Ishannz\LaravelEvernote\Facades\Evernote::class,
    ]
```

## Configuration

You can configure this in your .env file.

```php 
	LE_KEY=your evernote key
	LE_SECRET=your evernotte secrect
	LE_SANDBOX=true/flase
	LE_CALL_BACK= call back usel eg: /evernote/callback , ?action=callback
	LE_CHINA=false
```

to receive a token - Authentication

```php 
	Evernote::authorize();
```

