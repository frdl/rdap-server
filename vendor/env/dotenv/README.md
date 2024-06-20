# Dotenv
A simple and tiny PHP `.env` loader, which does not inject values into `$_ENV` or OS.
## Installation
```
composer require env/dotenv
```
## Usage
The .env file should have a valid [.ini](https://wikipedia.org/wiki/INI_file) syntaxis, supported by [parse_ini_file](https://www.php.net/manual/en/function.parse-ini-file.php).

This package does not inject values into global `$_ENV` or OS wia [putenv()](https://www.php.net/manual/en/function.putenv.php) so it's up to you how you wan't proceed with parsed data.

### Load
Parse `.env` and get values as array:
```php
$env = \Env\Dotenv::toArray(
    path: '.env',
    strict: false, // by default: true
);
```
If you need variables and fallback values, set strict to `false`
