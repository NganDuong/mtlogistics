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

    public function index() {
    	$userRoleId = $this->User->getUserRoleId($this->Auth->user('id'));

        if ($userRoleId !== ADMIN) {

            return $this->Flash->error(__('You are not authorized to access that location'));
        }

    	$users = $this->model->find('all', [
    		'conditions' => [],
    		'contain' => [
    			'UserRoles',
    		],
    	])->toArray();

    	$this->set(compact('users'));
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
}