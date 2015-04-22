<?php

include_once '../boot.php';

$callback = f(INPUT_GET, 'callback');

header('Content-type: application/json; charset=utf-8');
$result = json_encode(Cdc_Client_Cep::query(preg_replace('#\D#', '', f(INPUT_GET, 'cep'))));

if ($callback) {
    $result = $callback . '(' . $result . ');';
}

echo $result;
