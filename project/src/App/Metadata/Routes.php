<?php

namespace %namespace%\Metadata;

use Duke\Metadata\Resources as DR;
use Duke\RouterHelper as RH;

class Routes {

    public static function setup($router) {

        $router->map('login', array('class' => '\%namespace%\Controller\Login', 'resource' => 'none', 'login_controller' => '\%namespace%\Controller\Login'));
        $router->map('logout', array('class' => '\%namespace%\Controller\Login', 'resource' => 'authenticated', 'action' => 'logout', 'login_controller' => '\%namespace%\Controller\Login'));

        $router->map('', array('class' => '\%namespace%\Controller\Index', 'resource' => 'none', 'login_controller' => '\%namespace%\Controller\Login'), array('name' => 'home'));

        self::adminRoutes($router);
    }

    public static function adminRoutes($router) {
        $router->map('admin', array('class' => '\Duke\Controller\Index', 'resource' => 'authenticated'));
        RH::crud($router, 'duke/example', '\%namespace%\Definition\Example', DR::GERENCIAR_CONTEUDO);
    }

}
