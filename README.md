# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible, and secure. 
More information can be found at the [official site](http://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the 
[development repository](https://github.com/codeigniter4/CodeIgniter4).

**This is pre-release code and should not be used in production sites.**

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/). 


## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed: 

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)

## Install 
1 - install xampp or another LAMP Server

2 - import DB: in db folder into local mysql Server (if using local db)

3 - choose domain, example: bao24h.local

4 - modify hosts file (linux /etc/hosts, windows in systems32)

    127.0.0.1  www.bao24h.local

change base url in app/config/App.php

    public $baseURL = 'http://www.bao24h.local';

5 - config virtual hosts

    <VirtualHost *:80> 
        DocumentRoot "D:\ardor_code\bao24h\public_html"
        ServerName www.bao24h.local
        <Directory D:\ardor_code\bao24h\public_html>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride all
            Order Deny,Allow
            Allow from all
            Require all granted
        </Directory>
    </VirtualHost>

6 - unzip uploads.zip to public_html/upload

Note:
- db test
  
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'bao24h',
- change permision allow apache can write to folder
  
        writable/*
        public_html/assest



