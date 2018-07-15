<?php

namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;
use Cake\View\View;
use Cake\Log\Log;

class ContentHelper extends Helper {

    public function pageHeader($currentPage = false) {
        $view = new \Cake\View\View();
        $view->layout(false);
        $html = $view->render('/Element/header');

        return $html;
    }
}