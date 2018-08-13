<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Log\Log;

class UsersController extends CrudController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['logout']);

        $this->model = $this->Users;
        $this->modelName = 'Users';

        $this->loadComponent('UserRole');
        $this->loadComponent('User');
    }

    public function index($page = 0) {
    	$userRoleId = $this->User->getUserRoleId($this->Auth->user('id'));

        if ($userRoleId !== ADMIN) {

            return $this->Flash->error(__('You are not authorized to access that location'));
        }

    	$total = $this->model->find('all')->count();

        $_page = !empty($page) ? $page : PAGE;
        $results = $this->model->find('all', [
            'conditions' => [],
            'contain' => ['UserRoles'],
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

    public function login() {
    	$this->layout = false;

	    if ($this->request->is('post')) {
	        $user = $this->Auth->identify();
	        if ($user) {
	            $this->Auth->setUser($user);

	            $userRoleId = $this->User->getUserRoleId($this->Auth->user('id'));

		        switch ($userRoleId) {
		        	case ADMIN:
		        		
		        		return $this->redirect(['controller' => 'Orders', 'action' => 'index']);

		        	case SENDER:
		        		
		        		return $this->redirect(['controller' => 'Orders', 'action' => 'create']);

		        	case DELIVER:
		        		
		        		return $this->redirect(['controller' => 'Searchs', 'action' => 'index']);
		        	
		        	default:

		        		return $this->redirect($this->Auth->redirectUrl());
		        }

	            
	        }
	        $this->Flash->error('Your username or password is incorrect.');
	    }
	}

	public function logout() {
	    $this->Flash->success('You are now logged out.');
	    
	    return $this->redirect($this->Auth->logout());
	}

	public function create() {
		$userRoleId = $this->User->getUserRoleId($this->Auth->user('id'));

        if ($userRoleId !== ADMIN) {

            return $this->Flash->error(__('You are not authorized to access that location'));
        }
	    $roles = $this->UserRole->list();
        $this->set(compact('roles'));

	    if ($this->request->is('post')) {
	    	$user = $this->model->newEntity();
	    	$user = $this->model->patchEntity($user, $this->request->data);

	    	if (!$this->model->save($user)) {
	    		$this->Flash->error($user->errors());
	    	}

	    	return $this->redirect(['action' => 'index']);
	    }
	}

	/**
     * Update method.
     *
     * @return mixed.
     */
	public function update($id) {
		$this->loadModel('UserRoles');
		$roles = $this->UserRoles->find('all', [
            'conditions' => [],
        ])->toArray();
        $this->set(compact('roles'));

		$object = $this->model->find('all', [
            'conditions' => [
                'Users.id' => $id,
            ],
            'contain' => ['UserRoles'],
        ])->first();

        $this->set(compact('object'));

        if ($this->request->is('post')) {

        	if (empty($this->request->data['password'])) {
        		unset($this->request->data['password']);
        	}

            $object = $this->model->patchEntity($object, $this->request->data);

            if (!$this->model->save($object)) {

                return $this->Flash->error($object->errors());
            }
            $this->Flash->success(__('Updated'));

            return $this->redirect(['action' => 'index']);
        }
	}
}