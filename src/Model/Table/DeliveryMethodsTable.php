<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\ORM\Query;

/**
* 
*/
class DeliveryMethodsTable extends Table {
	
    public function initialize(array $config) {
		parent::initialize($config);
		$this->table('delivery_methods');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
	}

	public function validationDefault(Validator $validator) {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create', 'Please input your name')
            ->notEmpty('name', 'Please input your name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
        
        return $validator;
    }
}