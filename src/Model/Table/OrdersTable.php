<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\ORM\Query;

/**
* 
*/
class OrdersTable extends Table {
	
    public function initialize(array $config) {
		parent::initialize($config);
		$this->table('orders');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'className' => 'Customers',
            'foreignKey' => 'customer_id',
        ]);

        $this->belongsTo('PaymentMethods', [
            'className' => 'PaymentMethods',
            'foreignKey' => 'payment_method_id',
        ]);

        $this->belongsTo('DeliveryMethods', [
            'className' => 'DeliveryMethods',
            'foreignKey' => 'delivery_method_id',
        ]);

        $this->hasOne('Products', [
            'className' => 'Products',
            'foreignKey' => 'order_id',
            'dependent' => true,
        ]);  
	}

	public function validationDefault(Validator $validator) {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('order_code', 'create', 'Please input your order_code')
            ->notEmpty('order_code', 'Please input your order_code')
            ->add('order_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('customer_id')
            ->requirePresence('customer_id', 'create', 'Please input your customer_id')
            ->notEmpty('customer_id', 'Please input your customer_id');

        $validator
            ->requirePresence('price', 'create', 'Please input your price')
            ->notEmpty('price', 'Please input your price');

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create', 'Please input your quantity')
            ->notEmpty('quantity', 'Please input your quantity');
        
        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['customer_id'], 'Customers', "Invalid customer id"));
        $rules->add($rules->existsIn(['payment_method_id'], 'PaymentMethods', "Invalid payment id"));
        $rules->add($rules->existsIn(['delivery_method_id'], 'DeliveryMethods', "Invalid delivery id"));
        
        return $rules;
    }
}