<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;

class UserComponent extends CrudComponent {

	public function initialize(array $config) {
		$this->model = TableRegistry::get('Users');
		$this->modelName = 'Users';		
	}

	public function getUserRoleId($id) {
		$user = $this->model->find('all', [
			'conditions' => [
				'Users.id' => $id,
			],
			'contain' => [
				'UserRoles',
			],
		])->first();
		Log::info($user);

		if (!empty($user)) {
			
			return $user->user_role_id;
		} else {

			return 0;
		}
	}
}