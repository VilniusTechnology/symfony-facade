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
 
 - Symfony's dependency injection container with symfony config files.
 
 - Route porting. Routes that are configured in `routes.yml` files.
 
 - Symfony commands.
 
 
 As this package is still in early beta, not all functions and compatabilities are tested and developed.

Installation and configuration
==============================

Add it to composer:

` $ composer require lmikelionis/symfonys-facade `

Configuration
-------------
First you must enter configurational parameters in app.php file.
This can be done by adding following lines to app.php file:

```php
    'symfonysfacade_app_dir' => '/storage/symfony',
    'symfonysfacade_bundles' => '\VilniusTechnology\SymfonyBundles',

```

Setting `symfonysfacade_app_dir` - specifies symfony working directory path (where cache and `config.yml` 
files are stored).

Setting `symfonysfacade_bundles` - specifies namespace where Symfonys bundles are registered.

Namespaces should be set in `composer.json`:

``` json
    "autoload": {
        "classmap": [
            "database"
        ],
        "psr-4": {
            "App\\": "app/",
            "VilniusTechnology\\": "packages/VilniusTechnology/"
        }
    },

```

In namespace `VilniusTechnology` (path: `packages/VilniusTechnology/`) create file `SymfonyBundles.php`, 
with these contents:

``` php
    <?php
    
    namespace VilniusTechnology
    
    use FOS\JsRoutingBundle\FOSJsRoutingBundle;
    
    class SymfonyBundles
    {
        public static function getBundles()
        {
            return [
                new FOSJsRoutingBundle(),
            ];
        }
    }
    
```

In this file, you will be registering your Symfony bundles.

In path that was specified in `symfonysfacade_app_dir` (`storage/symfony`) create directory `config`
In it you should create or copy, usual symfonys configuration files (config.yml, parameters.yml and security.yml).

Set permissions, so Symfony could manage its working dir: `chmod storage/symfony 0755 `.

You are ready 2 Go ;)

Now install your Symfony bundle, in this case FOSJsRoutingBundle:

` $ composer require friendsofsymfony/jsrouting-bundle `.

Usage example
-------------

As an usage example I will use [...] .

It's a nice and easy PDO for ElasticSearch.


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
