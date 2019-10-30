# iPresence Test Task
This implementation is based on Laravel Lumen microframework.

## Installation
Prerequisites:
* PHP >= 7.2

Steps:
1. Unzip into some directory
2. `cd ipresence`
3. Run built-in php development server `php -S localhost:8123 -t public`

That's it, you can go to the api endpoint:
http://localhost:8123/shout/steve-jobs?limit=2

#Projects files
1. `app/Http/Controllers/QuotesController.php`
2. `app/Contracts/QuotesProvider.php`
3. `app/Adapters/CachingQuotes.php`
4. `app/Services/JsonQuotes.php`
5. `config/app.php`

#Tests
To run tests:
1. `cd ipresence`
2. `./vendor/phpunit/phpunit/phpunit --configuration ./phpunit.xml`

Tests are located at `tests/QuotesTest.php` file.

#Notes
1. This project do not contains any UI.
2. Some of dummy Example files provided by framework are not deleted.
3. Some unnecessary plugins and configurations are not removed.
