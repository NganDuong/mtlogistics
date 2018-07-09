<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;

class DeliveryMethodComponent extends CrudComponent {

	public function initialize(array $config) {
		$this->model = TableRegistry::get('DeliveryMethods');
		$this->modelName = 'DeliveryMethods';		
	}

	public function list() {

		return $this->model->find('all', [
			'conditions' => [],
		])->toArray();
	}
}