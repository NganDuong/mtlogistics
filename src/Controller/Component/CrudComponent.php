<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;

class CrudComponent extends Component {

	protected $model = null;
	protected $modelName = null;

	public function initialize(array $config) {}

	/**
	* Create method.
	*
	* @param array $data.
	*
	* @return mixed.
	*/
	public function create($data) {
		$newObject = $this->model->newEntity();

		$newObject = $this->model->PatchEntity($newObject, $data);

		if ($this->model->save($newObject)) {
			
			return $this->response(true, $newObject);
		} else {

			return $this->response(false, $newObject->errors());
		}
	}

	/**
	* Update method.
	*
	* @param array $conditions.
	* @param array $data.
	*
	*/
	public function update($conditions, $data) {
		$object = $this->model->find('all', [
			'conditions' => $conditions,
		])->first();

		if (empty($object)) {
			return $this->response(false, 'No ' . $this->modelName . ' found');
		}

		$object = $this->model->PatchEntity($object, $data);

		if ($this->model->save($object)) {
			
			return $this->response(true, $object);
		} else {

			return $this->response(false, $object->errors());
		}
	}

	/**
	* Get method.
	*
	* @param array $conditions.
	* @param array $contain.
	* @param array $fields.
	*
	*/
	public function get($conditions = [], $contain = [], $fields = []) {
		$object = $this->model->find('all', [
			'conditions' => $conditions,
			'contain' => $contain,
			'fields' => $fields,
		])->first();

		if (empty($object)) {

			return $this->response(false, 'No ' . $this->modelName . ' found');
		} else {

			return $this->response(true, $object);
		}
	}

	/**
	* Get all method.
	*
	* @param array $conditions.
	* @param array $contain.
	* @param array $fields.
	*
	*/
	public function getAll($conditions = [], $contain = [], $fields = []) {
		$objects = $this->model->find('all', [
			'conditions' => $conditions,
			'contain' => $contain,
			'fields' => $fields,
		])->toArray();

		if (empty($objects)) {

			return $this->response(false, 'No ' . $this->modelName . ' found');
		} else {

			return $this->response(true, $objects);
		}
	}

	/**
	* Delete method.
	*
	* @param array $conditions.
	*
	*/
	public function delete($conditions) {
		$object = $this->model->find('all', [
			'conditions' => $conditions,
		])->first();

		if (empty($object)) {
			return $this->response(false, 'No ' . $this->modelName . ' found');
		}

		if ($this->model->delete($object)) {
			
			return $this->response(true, 'Deleted');
		} else {

			return $this->response(false, $object->errors());
		}
	}

	/**
	* Response template.
	*
	* @param boolean $flag.
	* @param mixed $data.
	* 
	*/
	public function response($flag = true, $data) {
		
		return [
			'success' => $flag,
			'data' => $data,
		];
	}
}