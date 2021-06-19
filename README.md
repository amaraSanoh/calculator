# Calculator API  
Calculator api for web and mobile app  
In this project, PHP curl extension is activate for better performnce
And all of symfony equirements are enabled too (like opcache ...).  
Read Makefile file about some useful commands  


# Versions  
PHP version : PHP 8.0.3  
Symfony version : Symfony 5.3.2  
Docker version : Docker version 19.03.3  
Docker-compose version : docker-compose version 1.29.1  
Docker file format : 3.8 for docker version 19.03.0+  
Composer version : Composer version 2.0.14  
Use composer self-update --rollback to return to version 1.10.22  

# For the unit test  

# To specify a PHP version  
If you have multiple PHP versions installed on your computer, you can tell Symfony which one to use creating a file called .php-version at  the project root directory: Use a specific PHP version : echo 8.0.3 > .php-version
Use any PHP 8.x version available : echo 8 > .php-version

Run the command below if you don’t remember all the PHP versions installed on your computer:
symfony local:php:list