<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;

class CustomerComponent extends CrudComponent {

	public function initialize(array $config) {
		$this->model = TableRegistry::get('Customers');
		$this->modelName = 'Customers';		
	}

	/**
	* Create/Update method.
	*
	*/
	public function create($data) {
		$customer = $this->model->find('all', [
			'conditions' => [
				'phone' => $data['phone'],
			],
		])->first();

		if (empty($customer)) {
			$customer = $this->model->newEntity();
		}		

		$customer = $this->model->PatchEntity($customer, $data);

		if ($this->model->save($customer)) {
			
			return $this->response(true, $customer);
		} else {

			return $this->response(false, $customer->errors());
		}
	}
}