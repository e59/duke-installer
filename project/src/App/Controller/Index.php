<?php

namespace %namespace%\Controller;

class Index extends \%namespace%\Controller {

    public $index = 'home';

    public function indexAction() {
        ob_start();
        include $this->getTemplate('index.phtml', '%namespace%');
        return ob_get_clean();
    }
}
