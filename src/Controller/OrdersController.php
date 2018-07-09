<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Log\Log;

class OrdersController extends CrudController {

    public function initialize() {
        parent::initialize();

        $this->model = $this->Orders;
        $this->modelName = 'Orders';

        $this->loadComponent('Order');
        $this->loadComponent('Product');
        $this->loadComponent('Customer');
        $this->loadComponent('Photo');
        $this->loadComponent('ProductCategory');
        $this->loadComponent('PaymentMethod');
        $this->loadComponent('DeliveryMethod');
    }

    public function index($page = 0) {
        $conditions = [];
        $total = $this->model->find('all', [
            'conditions' => $conditions,
        ])->count();

        $_page = !empty($page) ? $page : PAGE;
    	$orders = $this->model->find('all', [
            'conditions' => $conditions,
            'contain' => [
                'Products',
                'Customers',
            ],
            'limit' => LIMIT,
            'page' => $_page,
        ])->toArray();
        // Log::info($orders);
        $this->set(compact('orders'));
        $next = 0;
        $prev = 0;
        $hasMore = (($total - $_page * LIMIT) > 0) ? $total - $_page * LIMIT : 0;

        if ($_page * LIMIT < $total) {
           $next = $_page + 1;
        }

        if ($_page - 1 > 0) {
           $prev = $_page - 1;
        }
        $this->set(compact('total'));
        $this->set(compact('hasMore'));
        $this->set(compact('next'));
        $this->set(compact('prev'));
    }

    public function create() {
        $productCategories = $this->ProductCategory->list();
        $this->set(compact('productCategories'));

        if ($this->request->is('post')) {
            // Log::info($this->request);
            // Create customer.
            $customerDatas = [
                'name' => $this->request->data['customer_name'],
                'nickname' => $this->request->data['customer_nick_name'],
                'phone' => $this->request->data['customer_phone'],
                'address' => $this->request->data['customer_address'],
            ];

            $this->loadModel('Customers');
            $customer = $this->Customers->newEntity();
            $customer = $this->Customers->patchEntity($customer, $customerDatas);

            if (!$this->Customers->save($customer)) {
                Log::info($customer->errors());
                $this->Flash->error(__('Unable to create/update customer.'));
            }
            // Log::info($customer);
            // Create order.
            $orderDatas = [
                'order_code' => '#' . Time::now()->toUnixString(),
                'customer_id' => $customer->id,
                'price' => $this->request->data['product_price'],
                'quantity' => $this->request->data['product_quantity'],
                'create_note' => $this->request->data['create_note'],
                'order_date' => date('Y/m/d', strtotime(str_replace('/', '-', $this->request->data['order_date']))),
            ];

            $order = $this->model->newEntity();
            $order = $this->model->patchEntity($order, $orderDatas);

            if (!$this->model->save($order)) {
                $this->Customers->delete($customer);
                $this->Products->delete($product);
                Log::info($order->errors());
                $this->Flash->error(__('Unable to create/update order.'));
            }

            // Create product.
            $productDatas = [
                'order_id' => $order->id,
                'name' => $this->request->data['product_name'],
                'product_category_id' => $this->request->data['product_category_id'],
                'size' => $this->request->data['product_size'],
            ];
            $this->loadModel('Products');
            $product = $this->Products->newEntity();
            $product = $this->Products->patchEntity($product, $productDatas);

            if (!$this->Products->save($product)) {
                Log::info($product->errors());
                $this->Flash->error(__('Unable to create/update product.'));
            }

            if (!empty($this->request->data['product_image']['name'])){
                $fileName = $this->request->data['product_image']['name'];
                $uploadPath = 'uploads/' . $fileName;
                $uploadFile = WWW_ROOT . $uploadPath;
                if (move_uploaded_file($this->request->data['product_image']['tmp_name'], $uploadFile)){
                    $this->loadModel('ProductPhotos');
                    $uploadData = $this->ProductPhotos->newEntity();
                    $uploadData->product_id = $product->id;
                    $uploadData->path = $uploadPath;
                    if (!$this->ProductPhotos->save($uploadData)) {
                        $this->Flash->error(__('Unable to upload file, please try again.'));
                    }
                } else{
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            }

            return $this->redirect(['action' => 'index']);
        }
    }

    public function update($id) {
        $order = $this->model->find('all', [
            'conditions' => [
                'Orders.id' => $id,
            ],
            'contain' => [
                'Customers',
                'PaymentMethods',
                'DeliveryMethods',
                'Products' => [
                    'ProductPhotos',
                    'ProductCategories',
                ],
            ],
        ])->first();

        // Log::info($order);

        if (!empty($order)) {

            if (!empty($order->order_date)) {
                $order->order_date = date('Y-m-d', strtotime($order->order_date));
            }            

            if (!empty($order->product->product_photo->path)) {
                $order->product->product_photo->path = 'http://' . $_SERVER['HTTP_HOST'] . DS . $order->product->product_photo->path;
            }        
        }
        $this->set(compact('order'));

        $productCategories = $this->ProductCategory->list();
        $this->set(compact('productCategories'));

        if ($this->request->is('post')) {
            // Log::info($this->request);
            // Create customer.
            $customerDatas = [
                'name' => $this->request->data['customer_name'],
                'nickname' => $this->request->data['customer_nick_name'],
                'phone' => $this->request->data['customer_phone'],
                'address' => $this->request->data['customer_address'],
            ];

            $this->loadModel('Customers');
            $customer = $order->customer;
            $customer = $this->Customers->patchEntity($customer, $customerDatas);

            if (!$this->Customers->save($customer)) {
                Log::info($customer->errors());
                $this->Flash->error(__('Unable to create/update customer.'));
            }
            // Log::info($customer);
            // Create order.
            $orderDatas = [
                'order_code' => $customer->phone,
                'customer_id' => $customer->id,
                'price' => $this->request->data['product_price'],
                'quantity' => $this->request->data['product_quantity'],
                'create_note' => $this->request->data['create_note'],
                'order_date' => date('Y/m/d H:i:s', strtotime(str_replace('/', '-', $this->request->data['order_date']))),
            ];

            $order = $this->model->patchEntity($order, $orderDatas);

            if (!$this->model->save($order)) {
                $this->Customers->delete($customer);
                $this->Products->delete($product);
                Log::info($order->errors());
                $this->Flash->error(__('Unable to create/update order.'));
            }

            // Create product.
            $productDatas = [
                'order_id' => $order->id,
                'name' => $this->request->data['product_name'],
                'product_category_id' => $this->request->data['product_category_id'],
                'size' => $this->request->data['product_size'],
            ];
            $this->loadModel('Products');
            $product = $order->product;
            $product = $this->Products->patchEntity($product, $productDatas);

            if (!$this->Products->save($product)) {
                Log::info($product->errors());
                $this->Flash->error(__('Unable to create/update product.'));
            }

            if (!empty($this->request->data['product_image']['name'])){
                $fileName = $this->request->data['product_image']['name'];
                $uploadPath = 'uploads/' . $fileName;
                $uploadFile = WWW_ROOT . $uploadPath;
                if (move_uploaded_file($this->request->data['product_image']['tmp_name'], $uploadFile)){
                    $this->loadModel('ProductPhotos');
                    $uploadData = $order->product->product_photo;
                    $uploadData->product_id = $product->id;
                    $uploadData->path = $uploadPath;
                    if (!$this->ProductPhotos->save($uploadData)) {
                        $this->Flash->error(__('Unable to upload file, please try again.'));
                    }
                } else{
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            }

            return $this->redirect(['action' => 'index']);
        }
    }

    public function view($id) {
        $paymentMethods = $this->PaymentMethod->list();
        $this->set(compact('paymentMethods'));

        $deliveryMethods = $this->DeliveryMethod->list();
        $this->set(compact('deliveryMethods'));

        $order = $this->model->find('all', [
            'conditions' => [
                'Orders.id' => $id,
            ],
            'contain' => [
                'Customers',
                'PaymentMethods',
                'DeliveryMethods',
                'Products' => [
                    'ProductPhotos',
                    'ProductCategories',
                ],
            ],
        ])->first();

        if (!empty($order->product->product_photo->path)) {
            $order->product->product_photo->path = 'http://' . $_SERVER['HTTP_HOST'] . DS . $order->product->product_photo->path;
        }

        // Log::info($order);
        $this->set(compact('order'));
    }

    public function sent($id) {

        if ($this->request->is('post')) {
            $order = $this->model->find('all', [
                'conditions' => [
                    'Orders.id' => $id,
                ]
            ])->first();

            if (!empty($order)) {
                $order->sent = Time::now();
                $order->payment_method_id = $this->request->data['payment_method_id'];

                if (!$this->model->save($order)) {
                    Log::info($order->errors());
                    $this->Flash->error(__('Unable to confirm sent.'));
                }

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Unable to confirm sent.'));
        }
    }

    public function delivered($id) {

        if ($this->request->is('post')) {
            $order = $this->model->find('all', [
                'conditions' => [
                    'Orders.id' => $id,
                ]
            ])->first();

            if (!empty($order)) {
                $order->delivered = Time::now();
                $order->delivery_note = $this->request->data['delivery_note'];
                $order->delivery_method_id = $this->request->data['delivery_method_id'];
                $order->delivery_name = $this->request->data['delivery_name'];

                if (!$this->model->save($order)) {
                    Log::info($order->errors());
                    $this->Flash->error(__('Unable to confirm delivered.'));
                }

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Unable to confirm delivered.'));
        }
    }
}