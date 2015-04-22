<?php

return array(
    'timezone' => 'America/Fortaleza',
    'title' => '%namespace%',
    'upload' => 'files',
    'upload_abs' => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'public_html' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR,
    'tmp' => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR,
    'root_abs' => dirname(__FILE__) . DIRECTORY_SEPARATOR,
    'labels' => include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'doc' . DIRECTORY_SEPARATOR . 'labels.php',
    'default_db' => 'default',
    'db' => array(
        'default' => array(
//            'dsn' => 'mysql:host=localhost;dbname=db_name',
//            'user' => 'root',
//            'pass' => 'myadmin',
//          'options' => array(
//              PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8, set date_format = \'%Y-%m-%d\'',
//          ),
        ),
    ),
    'authenticatorClass' => '\Duke\Authenticator\Database',
    'sender' => 'Sistema <root@localhost.localdomain>',
    'mailer' => array(
        'port' => 587,
        'host' => 'localhost.localdomain',
        'username' => 'root@localhost.localdomain',
        'password' => 'password',
        'secure' => 'tls',
    ),
    'modules' => array(
        'Duke' => implode(DIRECTORY_SEPARATOR, array(dirname(__FILE__), 'vendor', 'cangulo', 'duke', 'src')) . DIRECTORY_SEPARATOR,
        '%namespace%' => implode(DIRECTORY_SEPARATOR, array(dirname(__FILE__), 'src')) . DIRECTORY_SEPARATOR,
    ),
    'skins' => array(
        'duke' => array(
            'abs' => implode(DIRECTORY_SEPARATOR, array(dirname(__FILE__), 'vendor', 'cangulo', 'duke-skin-bootswatch')) . DIRECTORY_SEPARATOR,
            'debug' => '%webroot_dir%vendor/cangulo/duke-skin-bootswatch/',
            'production' => '/assets/skins/duke/',
        ),
        '%basedir%' => array(
            'abs' => implode(DIRECTORY_SEPARATOR, array(dirname(__FILE__), 'skins', '%basedir%')) . DIRECTORY_SEPARATOR,
            'debug' => '%webroot_dir%skins/%basedir%/',
            'production' => '/assets/skins/%basedir%/',
        ),
    ),
);


