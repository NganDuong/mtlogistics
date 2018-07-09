<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Log\Log;

class ProductPhotosController extends CrudController {

    public function initialize() {
        parent::initialize();

        $this->model = $this->ProductPhotos;
        $this->modelName = 'ProductPhotos';
    }

    public function index() {

    	if ($this->request->is('post')) {
    		// Log::info($this->request->data);
    		if (!empty($this->request->data['file']['name'])){
	            $fileName = $this->request->data['file']['name'];
	            $uploadPath = WWW_ROOT . 'uploads/';
	            $uploadFile = $uploadPath . $fileName;
	            // Log::info($uploadFile);
	            if (move_uploaded_file($this->request->data['file']['tmp_name'], $uploadFile)){
	                $uploadData = $this->model->newEntity();
	                $uploadData->product_id = $product->id;
	                $uploadData->path = $uploadPath;
	                if ($this->model->save($uploadData)) {
	                    $this->Flash->success(__('File has been uploaded and inserted successfully.'));
	                } else{
	                    $this->Flash->error(__('Unable to upload file, please try again.'));
	                }
	            } else{
	                $this->Flash->error(__('Unable to upload file, please try again.'));
	            }
	        } else{
	            $this->Flash->error(__('Please choose a file to upload.'));
	        }
    	}
    }
}