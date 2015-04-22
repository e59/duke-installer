<?php

include_once dirname(__DIR__) . '/boot.php';

list($controller, $content) = C::exec();


if (C::$response->isSent()) { // kill incorrect echoing inside controllers. Probably is a debug message anyways.
    echo $content;
    die;
}

if (!$content) {
    header('HTTP/1.1 404 Not Found');
    die('404');
}

if (C::$layoutTemplate) {
    include call_user_func_array(array($controller, 'getTemplate'), C::$layoutTemplate);
} else {
    echo $content;
}


