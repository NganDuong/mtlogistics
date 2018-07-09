<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;

class ProductComponent extends CrudComponent {

	public function initialize(array $config) {
		$this->model = TableRegistry::get('Products');
		$this->modelName = 'Products';		
	}
}