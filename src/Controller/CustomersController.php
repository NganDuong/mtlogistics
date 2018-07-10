<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Log\Log;

class CustomersController extends CrudController {

    public function initialize() {
        parent::initialize();

        $this->model = $this->Customers;
        $this->modelName = 'Customers';

        $this->loadComponent('Customer');
    }

    public function index() {
    	$customers = $this->Paginator->paginate($this->Customers->find());
        $this->set(compact('customers'));
    }

    public function view($id) {
        $customer = $this->model->find('all', [
            'conditions' => [
                'id' => $id,
            ],
        ])->first();

        $this->set(compact('customer'));
    }
}