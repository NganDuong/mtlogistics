<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Log\Log;

class ProductsController extends CrudController {

    public function initialize() {
        parent::initialize();

        $this->model = $this->Products;
        $this->modelName = 'Products';

        $this->loadComponent('ProductCategory');
    }

    public function index() {
    	$products = $this->model->find('all', [
    		'conditions' => [],
    		'contain' => [
                'ProductCategories',
            ],
    		// 'limit' => 10,
    		// 'page' => 1,
    	])->toArray();
        // Log::info($products);

    	$this->set(compact('products'));
    }

    public function create() {
        $categories = $this->ProductCategory->list();
        $this->set(compact('categories'));

        if ($this->request->is('post')) {
            $productDatas = [
                'name' => $this->request->data['product_name'],
                'product_category_id' => $this->request->data['product_category_id'],
                'size' => $this->request->data['product_size'],
            ];

            $product = $this->model->newEntity();
            $product = $this->model->patchEntity($product, $productDatas);

            if (!$this->model->save($product)) {
                Log::info($product->errors());
                $this->Flash->error(__('Unable to create/update product.'));
            }

            return $this->redirect(['action' => 'index']);
        }
    }
}