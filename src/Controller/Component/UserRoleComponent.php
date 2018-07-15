<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;

class UserRoleComponent extends CrudComponent {

	public function initialize(array $config) {
		$this->model = TableRegistry::get('UserRoles');
		$this->modelName = 'UserRoles';		
	}

	public function list() {

		return $this->model->find('all', [
			'conditions' => [],
		])->toArray();
	}
}