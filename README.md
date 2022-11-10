
## Installation / Project Setup

Install fresh laravel project 

    composer create-project laravel/laravel <project name>

Clone the repository

    git@github.com:alimulrazi/laravel-unit-test.git

Switch to the repo folder

    cd laravel-unit-test

Laravel Basic Commands
    php artisan route:list
    php artisan make:test TodoListTest
    php artisan make:factory TodoListFactory -m=TodoListFactory

To install xdebug

    sudo apt-get install php-xdebug

To see the test coverage in html report   

    vendor/bin/phpunit --coverage-html reports/

To see the test coverage in text mode

    XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-text 

Run test with artisan passing path for code coverage report

    php artisan test --coverage-html tests/reports/coverage

    vendor/bin/phpunit --coverage-html reports/

For run phpunit test in laravel by many ways ..

    vendor/bin/phpunit --filter methodName className pathTofile.php

    vendor/bin/phpunit --filter 'namespace\\directoryName\\className::methodName'

For test single class:

    vendor/bin/phpunit tests/Feature/UserTest.php
    vendor/bin/phpunit --filter  tests/Feature/UserTest.php
    vendor/bin/phpunit --filter 'Tests\\Feature\\UserTest'
    vendor/bin/phpunit --filter 'UserTest' 

For test single method:

    vendor/bin/phpunit --filter testExample 
    vendor/bin/phpunit --filter 'Tests\\Feature\\UserTest::testExample'
    vendor/bin/phpunit --filter testExample UserTest tests/Feature/UserTest.php

For run tests from all class within namespace:

    vendor/bin/phpunit --filter 'Tests\\Feature'
