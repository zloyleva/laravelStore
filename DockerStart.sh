#!/bin/bash

chmod -R 777 .; echo "$(date +%d-%m-%Y_%H:%M:%S) - chmod" >> docker.log;

#npm run production && echo "$(date +%d-%m-%Y_%H:%M:%S) - npm build" >> docker.log &

service mysql start && echo "$(date +%d-%m-%Y_%H:%M:%S) - mysql" >> docker.log

php artisan route:clear

service supervisor start & echo "$(date +%d-%m-%Y_%H:%M:%S) - supervisor" >> docker.log;

/usr/sbin/apache2ctl -D FOREGROUND
