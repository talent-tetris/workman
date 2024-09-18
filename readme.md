## require

* [laravel/sanctum](https://laravel.com/docs/11.x/passport) - Laravel Sanctum provides a featherweight authentication
  system for SPAs (single page applications), mobile applications, and simple, token based APIs. Sanctum allows each
  user of your application to generate multiple API tokens for their account. These tokens may be granted abilities /
  scopes which specify which actions the tokens are allowed to perform.
* [reefki/laravel-device-detector](https://github.com/reefki/laravel-device-detector) - The Laravel wrapper for Matomo
  Universal Device Detection library seamlessly integrates device detection capabilities into Laravel applications.

## start app from github

1. Pull Laravel/php project from git provider.
2. Rename `.env.example` file to `.env` inside your project root and fill the database information. (windows wont let
   you do it, so you have to open your console cd your project root directory and run `mv .env.example .env`)
3. Run `composer install` or `php composer.phar install`
4. Run `php artisan key:generate`
5. Run `php artisan migrate`
6. Run `php artisan db:seed` to run seeders, if any.
7. Run `php artisan serve`

## ErrorException failed to open stream: Permission denied

* Run `php artisan cache:clear`
* Run `chmod -R 777 storage/`
* Run `composer dump-autoload`

## SQLSTATE[HY000]: General error: 8 attempt to write a readonly database

* Run `chmod 0777 ./database/database.sqlite`
* Run `chmod 0777 ./database/`
