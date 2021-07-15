db_host=mariadb
db_name=db
db_name_test=db_test
db_user=root
db_password=xuburuFantik@1212

#LARAVEL

db-create:
	sleep 60
	docker-compose exec mariadb mysql --user=$(db_user) --password=$(db_password) -e "CREATE DATABASE IF NOT EXISTS $(db_name) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"
	docker-compose exec mariadb mysql --user=$(db_user) --password=$(db_password) -e "CREATE DATABASE IF NOT EXISTS $(db_name_test) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"


laravel-permission:
	-sudo chmod -R 755 ./src/
	-sudo chmod -R 777 ./src/storage ./src/backend/bootstrap/cache

laravel-run-phpunit:
	docker-compose exec --user $(shell id -u):$(shell id -g) php_fpm ./vendor/bin/phpunit

laravel-support-ide:
	docker-compose exec --user $(shell id -u):$(shell id -g) php_fpm php artisan ide-helper:generate
	docker-compose exec --user $(shell id -u):$(shell id -g) php_fpm php artisan ide-helper:meta
	docker-compose exec --user $(shell id -u):$(shell id -g) php_fpm php artisan ide-helper:models

laravel-cache-clear: laravel-permission
	docker-compose exec --user $(shell id -u):$(shell id -g)  php_fpm php artisan cache:clear
	docker-compose exec --user $(shell id -u):$(shell id -g)  php_fpm php artisan route:clear
	docker-compose exec --user $(shell id -u):$(shell id -g)  php_fpm php artisan view:clear
	docker-compose exec --user $(shell id -u):$(shell id -g)  php_fpm php artisan config:clear
	docker-compose exec --user $(shell id -u):$(shell id -g)  php_fpm php artisan config:cache

laravel-migrate-and-seed:
	docker-compose exec --user $(shell id -u):$(shell id -g) php_fpm php artisan migrate:fresh
	docker-compose exec --user $(shell id -u):$(shell id -g) php_fpm php artisan db:seed

laravel-passport-install:
	docker-compose exec --user $(shell id -u):$(shell id -g)  php_fpm php artisan passport:install

composer-install:
		docker-compose exec --user $(shell id -u):$(shell id -g) php_fpm composer install

laravel-router-list:
	docker-compose exec --user $(shell id -u):$(shell id -g) php_fpm php artisan route:list

#all
docker-up: docker-down
	docker-compose up -d --build

docker-log: docker-down
	docker-compose up --build

docker-down:
	docker-compose stop
	docker-compose down

clear-nginx-logs:
	-sudo rm -R ./nginx_logs/* ./nginx_logs/.*

clear-db:
	-sudo rm -R ./db/* ./db/.*

clear-src:
	-sudo rm -R ./src/* ./src/.*

clear-all: clear-nginx-logs clear-db clear-src

permission-755:
	sudo chmod -R 755 ./src/

permission-777:
	sudo chmod -R 777 ./src/


console:
	docker-compose exec --user $(shell id -u):$(shell id -g)  php_fpm /bin/bash

linter:
	docker-compose exec --user $(shell id -u):$(shell id -g)  php_fpm composer lint

cs-fix:
	docker-compose exec --user $(shell id -u):$(shell id -g)  php_fpm composer cs-fix

dev-lint: cs-fix linter

dev-support: laravel-support-ide dev-lint

dev-test: laravel-run-phpunit

dev-install: composer-install

dev-db: laravel-migrate-and-seed laravel-passport-install

dev-routes: laravel-router-list

dev-cache-clear: laravel-cache-clear

dev-permission: laravel-permission