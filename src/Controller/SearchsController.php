<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Log\Log;

class SearchsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('ProductCategory');
    }

    public function index() {
    	$productCategories = $this->ProductCategory->list();
        $this->set(compact('productCategories'));

        if ($this->request->is('post')) {
        	$conditions = [];

        	if (!empty($this->request->data['order_no'])) {
        		$_conditions = [
        			'Orders.order_code' => $this->request->data['order_no'],
        		];

        		$conditions = array_merge($conditions, $_conditions);
        	}

        	$this->loadModel('Orders');
        	$orders = $this->Orders->find('all', [
        		'conditions' => $conditions,
        		'contain' => [
	                'Customers',
	                'Products' => [
	                    'ProductPhotos',
	                    'ProductCategories'
	                ],
	            ],
        	])->toArray();
        	$this->set('orders', $orders);

        	return $this->render('/Searchs/result');
        }
    }
}