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
    public function index($page = 0) {
        $total = $this->model->find('all')->count();

        $_page = !empty($page) ? $page : PAGE;
        $results = $this->model->find('all', [
            'conditions' => [],
            'contain' => [],
            'limit' => LIMIT,
            'page' => $_page,
        ])->toArray();           

        $this->set(compact('results'));

        $next = 0;
        $prev = 0;
        $hasMore = (($total - $_page * LIMIT) > 0) ? $total - $_page * LIMIT : 0;

        if ($_page * LIMIT < $total) {
           $next = $_page + 1;
        }

        if ($_page - 1 > 0) {
           $prev = $_page - 1;
        }
        $currentPage = $_page;

        $this->set(compact('currentPage'));
        $this->set(compact('total'));
        $this->set(compact('hasMore'));
        $this->set(compact('next'));
        $this->set(compact('prev'));
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
		$object = $this->model->find('all', [
            'conditions' => [
                'id' => $id,
            ],
        ])->first();

        $this->set(compact('object'));

        if ($this->request->is('post')) {
            $object = $this->model->patchEntity($object, $this->request->data);

            if (!$this->model->save($object)) {
                // return $this->Flash->error(__('Unable to update customer.'));

                return $this->Flash->error($object->errors());
            }
            $this->Flash->success(__('Updated'));

            return $this->redirect(['action' => 'view', $id]);
        }
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
                // $this->Flash->error(__('Unable to delete'));

                return $this->Flash->error($object->errors());
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    public function view($id) {
        $object = $this->model->find('all', [
            'conditions' => [
                'id' => $id,
            ],
        ])->first();

        if (empty($object)) {
            
            return $this->Flash->error(__('No results found'));
        }

        $this->set(compact('object'));
    }
}