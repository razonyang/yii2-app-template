INSTALLATION
------------

```
$ git clone https://github.com/razonyang/yii2-app-template app
$ cd app
```

INITIALIZE
----------

```
$ cd app

$ docker-compose start php-fpm

$ docker-compose exec php-fpm php -r "file_put_contents('/app/composer.phar', file_get_contents('https://getcomposer.org/composer.phar'));"

$ docker-compose exec php-fpm php /app/bin/init --env=Docker

$ docker-compose exec php-fpm php /app/composer.phar --working-dir=/app install

$ docker-compose up --scale queue=5
```

- `./bin/init --env=Docker` for initializing docker configurations
- `docker-compose up` for starting docker services, add `-d` to run as daemon, `--scale queue=5` starts `5` queue workers.


DATABASE MIGRATION
------------------

```shell
$ docker-compose exec php-fpm /app/bin/yii migrate
```

WEB
---

```shell
$ curl -XPOST http://localhost:8080/api/backend/v1/login -H "Content-Type: application/json"
{"status":"fail","data":{"username":"Username cannot be blank.","password":"Password cannot be blank."}}

$ curl -XPOST http://localhost:8080/api/backend/v1/login -H "Content-Type: application/json" -d '{"username": "Admin", "password": "123456"}'
{"status":"success","data":{"id":1,"username":"Admin","email":"admin@example.com","token":"1YG-bENSZ7uQWWUVcytBZ-Vr7uHikT5I","expires_in":7200,"refresh_token":"1O3LL5FlVUBtdsKh2Dgj_r83jgmEbOCVtC1oAObpIhKs8QIpqdPV66t1SCywfL8k","refresh_token_expire_in":403200}}
```

Open [http://localhost:8080](http://localhost:8080) to take a look of the front end.

CONSOLE
-------

```shell
$ docker-compose exec php-fpm /app/bin/yii hello
Hello World
```

QUEUE
-----

```shell
$ docker-compose exec php-fpm /app/bin/yii hello/job
App\Console\Job\HelloJob#1
```

CRON
----

You should add your cron jobs into `resources/docker/cron/crontab`, and restart cron service `docker-compose restart cron`.

TESTS
-----

You should create test database(default to `yiitest`) and apply migrations into it.

```shell
$ docker-compose exec db mysql -uroot -p 
$ docker-compose exec php-fpm /app/bin/yii_test migrate
```

```shell
$ docker-compose exec php-fpm bash -c "cd /app/ && ./vendor/bin/codecept run --coverage --coverage-xml"
```
