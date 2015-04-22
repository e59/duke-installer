<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include dirname(dirname(__FILE__)) . '/init.php';

$hash = C::$hasher;

if (!isset($argv[1]))
{
        if (!isset($_GET['pass']))
        {
               die('Uso: ' . $argv[0] . ' <senha>' . PHP_EOL);
        }
        else
        {
                $pass = $_GET['pass'];
        }
}
else
{
        $pass = $argv[1];
}

echo $pass, ' => ', $hash->hashPassword($pass), PHP_EOL;
