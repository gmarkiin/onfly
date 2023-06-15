#!/usr/bin/make

# choco install make

.DEFAULT_GOAL := help

##@ Initialize work

init: ## Start a new development environment
	cp .env.example .env
	cp docker-compose.yml.example docker-compose.yml
	$(MAKE) dev
	@sleep 10
	$(MAKE) restore
	$(MAKE) install
	$(MAKE) migrate

##@ Docker actions

dev: ## Start containers detached
	docker-compose up -d

logs: ## Show the output logs
	docker-compose logs

log: ## Open the logs and follow the news
	docker-compose logs --follow

restart: ## Restart the app container
	docker-compose down
	docker-compose up -d

up: ## Put the project UP
	docker-compose up -d

down: ## Put the project DOWN
	docker-compose down

unlog: ## Clear log file
	docker-compose exec onfly-nginx bash -c "echo '' > storage/logs/laravel.log"

tinker: ## Start tinker
	docker-compose exec --user application onfly-nginx bash -c "php artisan tinker"

##@ Bash shortcuts

bash: ## Enter bash nginx container
	docker-compose exec --user application onfly-nginx bash

nginx: ## Enter bash nginx container
	docker-compose exec --user application onfly-nginx bash

mysql: ## Enter bash mysql container
	docker-compose exec onfly-mysql bash

##@ Database tools

migration: ## Create migration file
	docker-compose exec --user application onfly-nginx bash -c "php artisan make:migration $(name)"
	docker-compose exec --user application onfly-nginx bash -c "php artisan make:request RegisterPostRequest"

migrate: ## Perform migrations
	docker-compose exec --user application onfly-nginx php artisan migrate

fresh: ## Perform migrations
	docker-compose exec --user application onfly-nginx php artisan migrate:fresh

rollback: ## Rollback migration
	docker-compose exec --user application onfly-nginx php artisan migrate:rollback

backup: ## Export database
	docker-compose exec onfly-mysql bash -c "/var/www/app/.scripts/backup.sh"

restore: ## Import database
	docker-compose exec onfly-mysql bash -c "mysql --user=root --password=root onfly04 < /var/www/app/database/dump/FUNCTION.sql"
	docker-compose exec onfly-mysql bash -c "mysql --user=root --password=root onfly04 < /var/www/app/database/dump/TABLE.sql"
	docker-compose exec onfly-mysql bash -c "mysql --user=root --password=root onfly04 < /var/www/app/database/dump/VIEW.sql"
	docker-compose exec onfly-mysql bash -c "mysql --user=root --password=root onfly04 < /var/www/app/database/dump/DATA.sql"
	$(MAKE) password

password: ## Reset all passwords
	docker-compose exec onfly-mysql bash -c "mysql --user=onfly04 --password=123 onfly04 -e \"update TBL_USUARIO set usu_password = md5('aq1sw2de3')\""

##@ Composer

install: ## Composer install dependencies
	docker-compose exec --user application onfly-nginx bash -c "php artisan make:resource UserResource"

update: ## Composer install dependencies
	docker-compose exec --user application onfly-nginx bash -c "composer update"

autoload: ## Run the composer dump
	docker-compose exec --user application onfly-nginx bash -c "composer dump-autoload"

##@ General commands

route: ## List the routes of the app
	docker-compose exec --user application onfly-nginx php artisan route:list

##@ Docs

help: ## Print the makefile help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)
