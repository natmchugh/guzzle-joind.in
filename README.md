guzzle-joind.in
===============

[![Build Status](https://travis-ci.org/natmchugh/guzzle-joind.in.png?branch=master)](https://travis-ci.org/natmchugh/guzzle-joind.in)

An extensible client for [Joind.in API](http://joind.in/api/v2docs) version 2 using [Guzzle](http://guzzlephp.org) HTTP Client

##Instalation

### Installing via Composer

The recommended way to install Guzzle is through [Composer](http://getcomposer.org).

1. Add ``natmchugh/guzzle-joind.in`` as a dependency in your project's ``composer.json`` file:

        {
            "repositories": [
            {
                "type": "vcs",
                "url": "https://github.com/natmchugh/guzzle-joind.in"
            }
            ],
            "require": {
                "natmchugh/guzzle-joind.in": "dev-develop",
            }
        }

2. Download and install Composer:

        curl -s http://getcomposer.org/installer | php

3. Install your dependencies:

        php composer.phar install

4. Require Composer's autoloader

    Composer also prepares an autoload file that's capable of autoloading all of the classes in any of the libraries that it downloads. To use it, just add the following line to your code's bootstrap process:

        require 'vendor/autoload.php';

You can find out more on how to install Composer, configure autoloading, and other best-practices for defining dependencies at [getcomposer.org](http://getcomposer.org).

##Example Usage

```php
<?php
use Guzzle\JoindIn\JoindInClient;

$client = new JoindInClient();
$filters = $client->EventFilters();

```


