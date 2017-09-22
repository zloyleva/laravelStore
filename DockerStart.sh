#!/bin/bash

service mysql start &
service supervisor start &

/usr/sbin/apache2ctl -D FOREGROUND
