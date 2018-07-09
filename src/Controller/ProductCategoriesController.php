<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Log\Log;

class ProductCategoriesController extends CrudController {

    public function initialize() {
        parent::initialize();

        $this->model = $this->ProductCategories;
        $this->modelName = 'ProductCategories';
    }

    public function index() {
    	$categories = $this->Paginator->paginate($this->model->find());
        // Log::info($categories);
        $this->set(compact('categories'));
    }

    public function create() {

    	if ($this->request->is('post')) {
            // Log::info($this->request->data);
            $category = $this->model->find('all', [
                'conditions' => [
                    'id' => $this->request->data['id'],
                ],
            ])->first();

            if (empty($category)) {
                $category = $this->model->newEntity();
            }
    		
	        $category = $this->model->patchEntity($category, $this->request->data);

	        if (!$this->model->save($category)) {
	        	$this->Flash->error(__('Unable to create category.'));
	        }

	        return $this->redirect(['action' => 'index']);
    	}
    }

    public function update($id) {

        $category = $this->model->find('all', [
            'conditions' => [
                'id' => $id,
            ],
        ])->first();
        // Log::info($this->request->getParam('id'));
        // Log::info($category);

        if (!empty($category)) {
            $this->set(compact('category'));
        }
    }
}