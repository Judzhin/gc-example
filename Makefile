# Setup ————————————————————————————————————————————————————————————————————————
SHELL = bash
PROJECT = gc-example
EXEC_PHP = php
REDIS = redis-cli
GIT = git
GIT_AUTHOR = judzhin
SYMFONY = $(EXEC_PHP) bin/console
SYMFONY_BIN = ./symfony
COMPOSER = composer # || || $(EXEC_PHP) composer.phar
DOCKER = docker-compose
BREW = brew
.DEFAULT_GOAL = help
#.PHONY = # Not needed for now

help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

wait: ## Sleep 5 seconds
	sleep 5

## —— Composer 🧙‍♂️ ————————————————————————————————————————————————————————————
install: composer.lock ## Install vendors according to the current composer.lock file
	docker-compose run --rm gc-php-fpm $(COMPOSER) install

update: composer.json ## Update vendors according to the composer.json file
	docker-compose run --rm gc-php-fpm $(COMPOSER) update

## —— Docker 🐳 ————————————————————————————————————————————————————————————————
up: docker-compose.yaml ## Start the docker hub (MySQL,redis,adminer,elasticsearch,head,Kibana)
	$(DOCKER) -f docker-compose.yaml up -d

down: docker-compose.yaml ## Stop the docker hub
	$(DOCKER) down --remove-orphans

build-production:
    docker build --build-arg ENVIRONMENT=prod -f docker/nginx/Dockerfile -t judzhin/gc-nginx-example:v1 .
    docker build --build-arg ENVIRONMENT=prod -f docker/php-fpm/Dockerfile -t judzhin/gc-php-fpm-example:v1 .

push-production:
    docker push judzhin/gc-nginx-example:v1
    docker push judzhin/gc-php-fpm-example:v1