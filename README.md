# Calculator API  
Calculator api for web and mobile app  
In this project, PHP curl extension is activate for composer better   
And a lot of symfony requirements are enabled too (like opcache ...).  
Read Makefile file about some useful commands  
This project is build with Test Driven Development principle  
Design Pattern : This project uses 'DP Method' as a service to solve the arithmetic expressions  
To run this API tests, run the following command :  
symfony php bin/phpunit  
Otherwise, make tests works too if make exists as an environment variable  
It uses symfony server to run the app and symfony cli to execute any commands   
This app contains 27 unit tests  

# Entry-points  
This Api has only one entry-point. See it below :
/api/v1/compute  

# Project Requirements  
- PHP 8.0.7 (required)  
- Composer 2.0.14 (required)  
- Symfony cli 4.25.4 (not required)
- Make to run group of commands  (not reuired)  
- Compose and Docker (not required)  

# Instruction to run the app  
- symfony server:start -d  to start symfony server  
- docker-compose up -d to run containers (not required)  
- symfony php bin/phpunit to run the tests (not required)  
- If the server is running, make a request on /api/v1/compute entry-point to see {"error":"No expression found"} in your browser  
- Look at the tests class to understand how to make a post request  


# Versions  
PHP version : PHP 8.0.7  
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
To run php unit properly, enable php mbstring extension  


# To specify a PHP version  
If you have multiple PHP versions installed on your computer, you can tell Symfony which one to use creating a file called .php-version at  the project root directory: Use a specific PHP version : echo 8.0.7 > .php-version
Use any PHP 8.x version available : echo 8 > .php-version

Run the command below if you don’t remember all the PHP versions installed on your computer:
symfony local:php:list  

To enable PHP extensions inside of php.ini file, uncommented this line : extension_dir = "ext"  


# To install Apache and PHP8  
Follow this link  https://computingforgeeks.com/how-to-install-php-on-debian-linux/  

# Docker images and useful documents  
For more about bitmani apache, follow this link https://hub.docker.com/r/bitnami/apache#environment-variables  
For more about docker volume, follow this link https://docs.docker.com/storage/volumes/  
For more about compose and docker compatibility matrix, follow this link https://docs.docker.com/compose/compose-file/  
Bitnami/php https://docs.bitnami.com/tutorials/develop-http-api-php-containers/


