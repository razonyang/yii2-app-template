INSTALLATION
------------

```
$ composer create-project --prefer-dist razonyang/yii2-app-template app
```

or 

```
$ git clone https://github.com/razonyang/yii2-app-template app
$ cd app
$ composer install
```

INITIALIZE
----------

```shell
$ cd app

$ ./bin/init

$ ./bin/yii migrate
```

- `./bin/init` for initializing
- `./bin/yii migrate` for database migrations

> You should modify configurations located in `config` before `migrate`.

WEB
---

```shell
$ ./bin/yii serve

$ curl -XPOST http://localhost:8080/api/backend/v1/login -H "Content-Type: application/json"
{"status":"fail","data":{"username":"Username cannot be blank.","password":"Password cannot be blank."}}

$ curl -XPOST http://localhost:8080/api/backend/v1/login -H "Content-Type: application/json" -d '{"username": "Admin", "password": "123456"}'
{"status":"success","data":{"id":1,"username":"Admin","email":"admin@example.com","token":"1YG-bENSZ7uQWWUVcytBZ-Vr7uHikT5I","expires_in":7200,"refresh_token":"1O3LL5FlVUBtdsKh2Dgj_r83jgmEbOCVtC1oAObpIhKs8QIpqdPV66t1SCywfL8k","refresh_token_expire_in":403200}}
```

Open [http://localhost:8080](http://localhost:8080) to take a look of the front end.

CONSOLE
-------

```
$ ./bin/yii hello
Hello World
```

QUEUE
-----

```shell
$ ./bin/yii hello/job
App\Console\Job\HelloJob#1

$ ./bin/yii queue/listen -v
2019-08-06 12:30:28 [pid: 26514] - Worker is started
2019-08-06 12:30:51 [1] App\Console\Job\HelloJob (attempt: 1, pid: 26514) - Started
Hello World
2019-08-06 12:30:51 [1] App\Console\Job\HelloJob (attempt: 1, pid: 26514) - Done (0.081 s)
```

TESTS
-----

You should create test database(default to `yiitest`) and apply migrations into it.

```shell
$ ./bin/yii_test migrate
```

```shell
$ ./vendor/bin/codecept run --coverage --coverage-xml
```
