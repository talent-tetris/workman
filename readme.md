## require

* [laravel/passport](https://laravel.com/docs/11.x/passport) - Laravel Passport provides a full OAuth2 server implementation for your Laravel application in a matter of minutes. Passport is built on top of the League OAuth2 server that is maintained by Andy Millington and Simon Hamp.


## start app from github

1. Pull Laravel/php project from git provider.
2. Rename `.env.example` file to `.env` inside your project root and fill the database information. (windows wont let you do it, so you have to open your console cd your project root directory and run `mv .env.example .env`)
3. Run `composer install` or `php composer.phar install`
4. Run `php artisan key:generate`
5. Run `php artisan migrate`
6. Run `php artisan db:seed` to run seeders, if any. 
7. Run `php artisan passport:keys`
8. ```php artisan passport:client --password``` - создается два ключа. **_Client ID_** и **_Client secret_** - их необходимо скопировать и добавить в файл `.env` на ключи **PASSPORT_PASSWORD_CLIENT_ID** и **PASSPORT_PASSWORD_SECRET**
9. Run `php artisan serve`
