# **A rule-based tool for System-Theoretic Process Analysis (STPA)** 

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## **Prerequisites**

For execution of all commands, it is necessary the use of [Composer](https://getcomposer.org/download/) and [Node.js](https://nodejs.org/en/download/)

## **Installation**

Open a bash/git bash to clone the repository

```
#!npm
git clone https://bitbucket.org/FellipeRey/stpatool
```


In stpatool folder, we need install Gulp, an automated task runner. Typing the command below, a new folder (node_modules) will be created with the content of Gulp.

```
#!npm
npm install -g gulp
```


To install the remaining dependencies, execute the command:

```
#!npm
npm install
```


Some folders Laravel (like the contents of the vendor folder) do not change, so it is not necessary to send them to the repository, it can be obtained through the command:

```
#!composer
composer install
```


Gulp is the responsible to get all views, css, images and javascripts files(folder resources), compile them and send to the public folder.

```
#!composer
gulp
```


A new key must be generated for the new Laravel application. 

```
#!composer
php artisan key:generate
```


**Attention!**
The last step is to create a new .env file. Copy the content of .env.example and modify using your database configuration.


## **Running the application**

After complete the Installation, you must open two bashes and execute the commands:

```
#!bash

php artisan serve
```
and
```
#!bash

gulp watch
```

**Attention! ** If no change in the resources folder, it is not necessary to run the second command (gulp watch)


## Laravel Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).