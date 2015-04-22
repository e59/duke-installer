<?php

bcscale(10);
assert_options(ASSERT_BAIL, true);

$loader = require __DIR__ . '/vendor/autoload.php';

require 'C.php';
C::$loader = $loader;

$settings = require __DIR__ . DIRECTORY_SEPARATOR . 'settings.php';
$baseSettings = require __DIR__ . DIRECTORY_SEPARATOR . 'base.settings.php';

$application = \Nette\Utils\Arrays::get($_SERVER, 'application', null);

if (null !== $application) {
    $root = __DIR__;
    require __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $application . DIRECTORY_SEPARATOR . 'init.php';
}

C::source($settings, $baseSettings);
