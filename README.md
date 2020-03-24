Yii2 App Template
-----------------

[![Build Status](https://travis-ci.org/razonyang/yii2-app-template.svg?branch=master)](https://travis-ci.org/razonyang/yii2-app-template)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/razonyang/yii2-app-template/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/razonyang/yii2-app-template/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/razonyang/yii2-app-template/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/razonyang/yii2-app-template/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/razonyang/yii2-app-template.svg)](https://packagist.org/packages/razonyang/yii2-app-template)
[![Total Downloads](https://img.shields.io/packagist/dt/razonyang/yii2-app-template.svg)](https://packagist.org/packages/razonyang/yii2-app-template)
[![LICENSE](https://img.shields.io/github/license/razonyang/yii2-app-template)](LICENSE)

Yii2 App Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex web applications with multiple tiers.

There is a [Yii2 Vue Admin](https://github.com/razonyang/yii2-vue-admin) for building a back end application.

- [Demo](#demo)
- [Documentation](#documentation)
- [Directory Structure](#directory-structure)
- [Credit](#credit)

DEMO
----

- Yii2 front end and API - https://yii2.razonyang.com
- Yii2 Vue Admin - https://yii2-admin.razonyang.com

DOCUMENTATION
-------------

- [Installation](docs/en/INSTALLATION.md)
- [Installation via Docker](docs/en/DOCKER.md)

DIRECTORY STRUCTURE
-------------------

```
app
    Console/             
        Controller/              contains console controller classes
        Model/                   contains console model classes
        Job/                     contains console job classes
    Exception/                   contains exception classes
    Form/                        contains form classes
    Http/
       Api/
           Backend/              contains back end API classes
           Frontend/             contains front end API classes
       Asset/                    contains web assets such as JavaScript and CSS
       Controller/               contains web controller classes
       Filter/                   contains web filters
       Form/                     contains web form classes
       Model/                    contains web model classes
       Module/                   contains web modules
       Widget/                   contains web widgets
    Job/                         contains web job classes
    Model/                       contains model classes
    Rbac/
        Rule/
    Validator/                   contains validators
bin/                             contains scripts
conf/                            contains conf files, such as crond job, systemd service unit etc
config/                          contains all of app configurations
public/                          contains the entry script and web resources
resources
    environments/                contains environment-based overrides
    mail/                        contains view files for e-mails
    messages/                    contains I18N messages
    migrations/                  contains database migrations
    views/                       contains view files for the Web application
tests/                           contains tests    
vendor/                          contains dependent 3rd-party packages
```

Credit
------

It is a fork of [Yii2 Advanced Template](https://github.com/yiisoft/yii2-app-advanced)
