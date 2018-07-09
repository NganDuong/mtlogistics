<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\ORM\Query;

/**
* 
*/
class CustomersTable extends Table {
	
    public function initialize(array $config) {
		parent::initialize($config);
		$this->table('customers');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasMany('Orders', [
            'className' => 'Orders',
            'foreignKey' => 'customer_id',
            'dependent' => true,
        ]);
	}

	public function validationDefault(Validator $validator) {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('phone', 'create', 'Please input your phone')
            ->notEmpty('phone', 'Please input your phone')
            ->add('phone', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
        
        return $validator;
    }
}