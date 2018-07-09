<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\ORM\Query;

/**
* 
*/
class ProductsTable extends Table {
	
    public function initialize(array $config) {
		parent::initialize($config);
		$this->table('products');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasOne('ProductPhotos', [
            'className' => 'ProductPhotos',
            'foreignKey' => 'product_id',
            'dependent' => true,
        ]);

        $this->belongsTo('ProductCategories', [
            'className' => 'ProductCategories',
            'foreignKey' => 'product_category_id',
        ]);

        $this->belongsTo('Orders', [
            'className' => 'Orders',
            'foreignKey' => 'order_id'
        ]);
	}

	public function validationDefault(Validator $validator) {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create', 'Please input your name')
            ->notEmpty('name', 'Please input your name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('product_category_id')
            ->requirePresence('product_category_id', 'create', 'Please input your product_category_id')
            ->notEmpty('product_category_id', 'Please input your product_category_id');

        $validator
            ->integer('order_id')
            ->requirePresence('order_id', 'create', 'Please input your order_id')
            ->notEmpty('order_id', 'Please input your order_id');

        $validator
            ->requirePresence('size', 'create', 'Please input your size')
            ->notEmpty('size', 'Please input your size');
        
        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['product_caregory_id'], 'ProductCategories', "Invalid category id"));
        $rules->add($rules->existsIn(['order_id'], 'Orders', "Invalid order id"));
        
        return $rules;
    }
}