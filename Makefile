# make -- утилита для linux, под виндой её можно использовать из терминала https://cygwin.com/
# мини гайд https://guides.hexlet.io/makefile-as-task-runner/
# пример запуска команды -- из директории с файлом Makefile выполнить make up
up:
	docker-compose down
	cp -u docker/php-fpm/conf/99-overrides.ini.example docker/php-fpm/conf/99-overrides.ini
	cp -u docker/nginx/conf/app.conf.example docker/nginx/conf/app.conf
	rm -rfv docker/nginx/log/*.log
	docker-compose up -d --build
	docker-compose run --rm -e XDEBUG_MODE=off php-fpm composer install
	echo "site will be available on http://127.0.0.1:8222/"
up-build:
	docker-compose up --build
down:
	docker-compose down
stop:
	docker-compose stop
composer-install:
	docker-compose run --rm -e XDEBUG_MODE=off php-fpm composer install
composer-update:
	docker-compose run --rm -e XDEBUG_MODE=off php-fpm composer update