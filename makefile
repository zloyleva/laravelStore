docker_name = laravelstore_web_1

help: #prints list of commands
	@cat ./makefile | grep : | grep -v "grep"

install: #start docker container #
	@cp ./.env.example ./.env && sudo docker-compose up -d && sudo docker exec -it $(docker_name) bash -c 'php composer.phar update && chmod -R 777 . && php composer.phar dump-autoload && php artisan migrate:refresh --seed'

scenario: #scenario deploy
	@cp ./.env.scenario ./.env && php composer.phar update && chmod -R 777 . && php composer.phar dump-autoload && npm i && artisan migrate:refresh --seed && npm run production && service supervisor restart && mkdir -m 777 public/img/tmp

start: #start docker container #
	@sudo sudo docker-compose up -d

stop: #stop docker container
	@sudo sudo docker-compose down

remove: #remove docker image
	@sudo docker-compose down; sudo docker rmi -f $(docker_name)

composer_update: #update vendors
	@sudo docker exec -it $(docker_name) bash -c 'php composer.phar update && chmod -R 777 . && php composer.phar dump-autoload'

composer_dump: #update vendors
	@sudo docker exec -it $(docker_name) bash -c 'php composer.phar dump-autoload'

set_env: #set default environments
	@cp ./.env.example ./.env

create_controller: #create controller name=[controllerName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:controller $(name) && chmod -R 777 .'

create_model: #create model name=[modelName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:model "Models\$(name)" -m && chmod -R 777 .'

create_seeder: #create seeder name=[seederName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:seeder $(name) && chmod -R 777 .'

create_test: #create test name=[testName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:test $(name) && chmod -R 777 .'

create_email: #create email name=[emailName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:mail $(name) && chmod -R 777 .'

create_middleware: #create middleware name=[emailName]
	@sudo docker exec -it $(docker_name) bash -c 'php artisan make:middleware $(name) && chmod -R 777 .'

migration: #run migration
	@sudo docker exec -it $(docker_name) bash -c 'php composer.phar dump-autoload && php artisan migrate'

seed: #run migration
	@sudo docker exec -it $(docker_name) bash -c 'php composer.phar dump-autoload && php artisan db:seed'

refresh: #Refresh the database and run all database seeds
	@sudo docker exec -it $(docker_name) bash -c 'php composer.phar dump-autoload && php artisan migrate:refresh --seed'

chmod: #allow RW to all
	@sudo chmod -R 777 .

route: #show all routes
	@sudo docker exec -it $(docker_name) bash -c 'php artisan route:list'

conf: #refresh config cache
	@sudo docker exec -it $(docker_name) bash -c 'php artisan config:cache'

test: #run test cases
	@sudo docker exec -it $(docker_name) bash -c 'vendor/bin/phpunit'

mix_dev: #run mix in dev mode
	@sudo docker exec -it $(docker_name) bash -c 'npm run dev && chmod -R 777 .'

mix_prod: #run mix in prod mode
	@sudo docker exec -it $(docker_name) bash -c 'npm run production && chmod -R 777 .'

mix_watch: #run mix in watch
	@sudo docker exec -it $(docker_name) bash -c 'npm run watch && chmod -R 777 .'

clear_cache: #clear laravel cache
	@sudo docker exec -it $(docker_name) bash -c 'php artisan cache:clear && php artisan view:clear'

clear_log: #clear laravel log
	@sudo echo > storage/logs/laravel.log

chat: #start chat service
	@sudo docker exec -it $(docker_name) bash -c 'php artisan chat:serve'

connect: #connect to container bash
	@sudo docker exec -it $(docker_name) bash
