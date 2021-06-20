# Calculator API  
Calculator api for web and mobile app  
In this project, PHP curl extension is activate for better performnce
And all of symfony equirements are enabled too (like opcache ...).  
Read Makefile file about some useful commands  
This project is build with Test Driven Development principle  
Design Pattern : This project uses DP Strategy as a service to solve the arithmetic expressions  


# Versions  
PHP version : PHP 8.0.3  
Symfony version : Symfony 5.3.2  
Docker version : Docker version 19.03.3  
Docker-compose version : docker-compose version 1.29.1  
Docker file format : 3.8 for docker version 19.03.0+  
Composer version : Composer version 2.0.14  
Use composer self-update --rollback to return to version 1.10.22  
PHPunit version : PHPUnit 9.5.5 by Sebastian Bergmann and contributors.  


# For the unit test  
Install the symfony/http-client and symfony/browser-kit packages to enabled the API Platform test client  
To install phpunit : composer require --dev phpunit/phpunit  
To install the dependencies for the tests  
composer require test  
Don't forget to install symfony/test-pack like below  
composer require --dev symfony/test-pack symfony/http-client justinrainbow/json-schema  


# To specify a PHP version  
If you have multiple PHP versions installed on your computer, you can tell Symfony which one to use creating a file called .php-version at  the project root directory: Use a specific PHP version : echo 8.0.3 > .php-version
Use any PHP 8.x version available : echo 8 > .php-version

Run the command below if you don’t remember all the PHP versions installed on your computer:
symfony local:php:list