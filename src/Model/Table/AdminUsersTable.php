<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\ORM\Query;

/**
* 
*/
class AdminUsersTable extends Table {
	
    public function initialize(array $config) {
		parent::initialize($config);
		$this->table('admin_users');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');      
	}

	public function validationDefault(Validator $validator) {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('username', 'create', 'Please input your username')
            ->notEmpty('username', 'Please input your username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'Please input your password');
        
        return $validator;
    }
}