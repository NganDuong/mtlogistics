<?php

namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event;
use Cake\Utility\Inflector;
use Cake\Log\Log;

abstract class CrudController extends AppController {
	protected $model = null;
	protected $modelName = null;
    protected $limit = 1;
    protected $page = 1;

    public function initialize() {
        parent::initialize();

        $this->loadComponent('Crud');
    }

    public function isAuthorized($user) {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['index', 'view', 'update', 'delete', 'create'])) {

            return true;
        }
    }

    /**
     * Index method.
     *
     * @return mixed.
     */
    public function index() {
        $results = $this->Paginator->paginate($this->model->find());
        $this->set(compact('results'));
    }

	/**
     * Create method.
     *
     * @return mixed.
     */
	public function create() {
		
        $object = $this->Crud->create($this->request->data);

        if (!$object['success']) {
            
            $this->Flash->error($object['data']);
        }


	}

	/**
     * Update method.
     *
     * @return mixed.
     */
	public function update($id) {
		
	}

	/**
     * Delete method.
     *
     * @return mixed.
     */
    public function delete($id) {

        $object = $this->model->find('all', [
            'conditions' => [
                'id' => $id,
            ],
        ])->first();

        if (!empty($object)) {
            
            if (!$this->model->delete($object)) {
                $this->Flash->error('Unable to delete');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}