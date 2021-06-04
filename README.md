## Installation

The Evernote cloud Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the
`ishannz/laravel-evernote-cloud` package and setting the `minimum-stability` to `dev` (required for Laravel 5) in your
project's `composer.json`.

```json
{
    "require": {
        "ishannz/laravel-evernote-cloud": "^2.0"
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
        Ishannz\LaravelEvernote\LaravelEvernoteServiceProvider::class,
    ]
```

Find the `aliases` key in `config/app.php`.

```php
    'aliases' => [
        // ...
        'Evernote' => Ishannz\LaravelEvernote\Facades\Evernote::class,
    ]
```

Publish the config file of the package.
```bash
php artisan vendor:publish --provider="Ishannz\LaravelEvernote\LaravelEvernoteServiceProvider" --tag=config
```

For Laravel 5 use [1.0.0](https://github.com/ishannz/laravel-evernote-cloud/tree/1.0.0)

## Configuration

You can configure this in your .env file.

```php 
	EVERNOTE_KEY=your evernote key
	EVERNOTE_SECRET=your evernote secrect
	EVERNOTE_SANDBOX=true/false
	EVERNOTE_CALL_BACK=callback url eg: /evernote/callback , ?action=callback
	EVERNOTE_CHINA=false
```

to receive a token - Authentication

```php 
	Evernote::authorize();
```

