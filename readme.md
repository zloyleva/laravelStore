<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

#Laravel store

 >install dependencies

###Install Docker
*see here:*
[Docker install link](https://docs.docker.com/engine/installation/linux/docker-ce/ubuntu/#install-from-a-package)

###Install Docker Compose
*see here:*
[Docker-Compose link](https://docs.docker.com/compose/install/#install-compose)

=====================
###Make environment
*Install and run Docker container*

```
$ make install
$ make start
```

Queue:
*Call ones for create queue's table if no have current tables*
```
$ php artisan queue:table
$ php artisan queue:failed-table
```

Todo: *add listener comand to Docker start file* 
```
$ php artisan queue:listen --tries=2
```
If you got error: "No application encryption key has been specified."
```
$ php artisan key:generate
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
