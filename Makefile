SHELL := /bin/bash 

tests: 
	symfony php bin/phpunit 
.PHONY: tests 

stop-services: 
	symfony server:stop 
	docker-compose stop 
.PHONY: stop-services 

start-services: 
	symfony server:start -d 
	docker-compose up -d 
.PHONY: start-services

check-env-vars: 
	symfony var:export --multiline
.PHONY: check-env-vars

requirements: 
	symfony check:requirements
.PHONY: requirements

php-versions: 
	symfony local:php:list
.PHONY: php-versions