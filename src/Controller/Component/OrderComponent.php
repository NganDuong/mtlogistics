<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;

class OrderComponent extends CrudComponent {

	public function initialize(array $config) {
		$this->model = TableRegistry::get('Orders');
		$this->modelName = 'Orders';		
	}

	public function getOrderForPrint($id, $fields = []) {

		return $this->model->find('all', [
			'conditions' => [
				'Orders.id' => $id,
			],
			'contain' => [
				'Customers',
                'PaymentMethods',
                'DeliveryMethods',
                'Products' => [
                    'ProductPhotos',
                    'ProductCategories',
                ],
			],
			'fields' => $fields,
		])->first();
	}

	public function getOrderSearchForPrint($ids, $fields = []) {

		return $this->model->find('all', [
			'conditions' => [
				'Orders.id IN' => $ids,
			],
			'contain' => [
				'Customers',
                'PaymentMethods',
                'DeliveryMethods',
                'Products' => [
                    'ProductPhotos',
                    'ProductCategories',
                ],
			],
			'fields' => $fields,
		])->toArray();
	}
}