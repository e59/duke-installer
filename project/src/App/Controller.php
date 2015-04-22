<?php

namespace %namespace%;

class Controller extends \Duke\Controller {

    public $module = '%namespace%';

    // example menu
    public function buildMenu($breadcrumb = false) {
        $menu = \C::$menuFactory->createItem('%namespace%');

        if ($breadcrumb) {
            $menu->setChildrenAttribute('class', 'breadcrumb');
        } else {
            $menu->setChildrenAttribute('class', 'unlisted-style clearfix');
            $menu->setChildrenAttribute('id', 'main-menu');
        }

        $menu->addChild('home', array(
            'uri' => $this->link('home'),
            'label' => 'Home',
            'extras' => array(
                'index' => 'home',
            ),
        ));

        $options = array(
            'allow_safe_labels' => true,
            'breadcrumb_clean_labels' => true,
            'currentClass' => 'active',
            'ancestorClass' => 'active',
            'lastClass' => 'last-child',
            'branch_class' => 'dropdown',
        );

        return compact('menu', 'options');
    }

}
