[![Scrutinizer Code Quality]
(https://scrutinizer-ci.com/g/VilniusTechnology/symfony-facade/badges/quality-score.png?b=master)]
(https://scrutinizer-ci.com/g/VilniusTechnology/symfony-facade/?branch=master)

![CodeCoverage](https://scrutinizer-ci.com/b/lmikelionis/symfonys-facade/badges/coverage.png?b=master)

![TravisBuild](https://travis-ci.org/VilniusTechnology/symfony-facade.svg)


Symfonys facade for Laravel5
====================

This package lets you use Symfony2 specific bundles inside Laravel5 application.
Simply add you Symfony centric bundle to `composer.json` install it, configure it and enjoy it ;)

 It supporst such features as:
 
 - Symfony's dependency injection container that loads from standard symfony config files.
 
 - Route porting. Routes that are configured in `routes.yml` files are being accessible from Laravel.
 
 - Symfony commands can be executed with artisan command of from admin form.
 
 
 As this package is still in early beta, not all functions and compatibilities are tested and developed.

Installation and configuration
==============================

Add it to composer:

` $ composer require vilnius-technology/symfonys-facade dev-master`


Register pacakage
-----------------

Add this to the bottom of your `config\app.php` in to providers key:
```php

  /*
  * Custom
  */
 'VilniusTechnology\SymfonysFacade\SymfonysFacadeServiceProvider',
 
```

Register console command interpreters interface route, by adding this to your applicatins routing:

```php
 // SymfonysFacades warmup.
 Route::match(
     ['get', 'post'],
     '/sfbInstall',
     [
         'uses' => '\VilniusTechnology\SymfonysFacade\Controllers\ManagerController@interpreter',
     ]
 );
```

In namespace `VilniusTechnology` (path: `$LARVEL_PROJECT_ROOT/packages/VilniusTechnology/`) create file `SymfonyBundles.php`, with these contents:

``` php
    <?php
    
    namespace VilniusTechnology;
    
    class SymfonyBundles
    {
        public static function getBundles()
        {
            return [
            ];
        }
    }
```
This is where your Symfony bundles will be registered. Familiar isin't it? :)

Add bundle loading class namespace loading to composer.json:
```json
 "psr-4": {
             "App\\": "app/",
             "VilniusTechnology\\": "packages/VilniusTechnology/"
         }
```

You can change it to your, but if you will follow tutorial, this is default registered bundles loader.
More details in configuration section.

Now run `composer dump-autoload`.

Copy contents of `vendor/vilnius-technology/symfony-facade/Tests/symfony/config` to 
`storage/app/symfony/config`.
You can do this by running command: 
`mkdir storage/app/symfony/config ; 
cp -a vendor/vilnius-technology/symfonys-facade/Tests/symfony/config storage/app/symfony`.

You are ready 2 Go ;)

Into text box enter: `debug:container`. Pres Go.

If you got a list of symfonys services, congrats. Now You can move to symfonys bundle instalations on Laravel 5.1 tutorial.

Follow this example tutorial [tutorial](docs/fos.md) to get know, how precisely install Symfony2 bundles, with default configuration


Customizable configuration
--------------------------
First you can enter configurational parameters in app.php file.
This can be done by adding following lines to app.php file:

```php
    'symfonysfacade_app_dir' => '/storage/symfony',
    'symfonysfacade_log_dir' => '/storage/symfony/logs'
    'symfonysfacade_bundles' => '\VilniusTechnology\SymfonyBundles',

```

If you wont do that default ones will be set in `$LARVEL_PROJECT_ROOT/storage/app/symfony/env` ending with your projects deployment evironment.

Setting `symfonysfacade_app_dir` - specifies symfony working directory path (where cache and `config.yml` 
files are stored). Cache and log directories will be stored there also.

Setting `symfonysfacade_bundles` - specifies namespace where Symfonys bundles are registered. In this case use `\VilniusTechnology\SymfonyBundles`, if you are following this document as tutorial.

In this file, you will be registering your Symfony bundles.

In path that was specified in `symfonysfacade_app_dir` (`storage/symfony`) create directory `config`
In it you should create or copy, usual symfonys configuration files (config.yml, parameters.yml and security.yml).

License
---------
This bundle is under the MIT license. 

Some other stuff
----------------

Probably there is natural question, why use Symfony's bundles in Laravel.
Answer is: Because I want so :D

Yes for libraries, not bundles, there is no need to use such thing.
But in World Wide Web there is many good bundles, that are using actual Symfony framework.

So as I wanted to use Symfony specific bundle in Laravel5 project, that I didnt saw to be ported easily. 
At the end of the day we have this package.

Also this facde can be usefull if in need of fast prototyping. Jus include it, register it and you have 
Symfony inside Laravel5 ;)
