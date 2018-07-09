<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\ORM\Query;

/**
* 
*/
class ProductPhotosTable extends Table {
	
    public function initialize(array $config) {
		parent::initialize($config);
		$this->table('product_photos');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');      
	}

	public function validationDefault(Validator $validator) {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('product_id')
            ->requirePresence('product_id', 'create', 'Please input your product_id')
            ->notEmpty('product_id', 'Please input your product_id');

        $validator
            ->requirePresence('path', 'create', 'Please input your path')
            ->notEmpty('path', 'Please input your path');
        
        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['product_id', 'path'], 'This product_id & path combination has already been used.'));

        return $rules;
    }
}