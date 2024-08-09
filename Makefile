create: up ps

up:
	docker-compose up -d
ps:
	docker-compose ps
rebuild:
	docker-compose down
	docker-compose build --no-cache
	make up
php:
	docker-compose exec php sh
go: up ps php

down:
	docker-compose down
