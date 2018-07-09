<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Log\Log;

class AdminUsersController extends CrudController {

    public function initialize() {
        parent::initialize();

        $this->model = $this->AdminUsers;
        $this->modelName = 'AdminUsers';
    }

    public function index() {
    	
    }
}