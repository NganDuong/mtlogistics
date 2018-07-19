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
        $this->loadComponent('User');
    }

    public function isAuthorized($user) {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['index', 'create', 'view', 'update', 'delete', 'sent', 'delivered'])) {

            return true;
        }
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

        foreach ($orders as $order) {
            if (!empty($order->sent)) {
                $order->sent_img = 'http://' . $_SERVER['HTTP_HOST'] . DS . 'img/checked.png';
            } else {
                $order->sent_img = 'http://' . $_SERVER['HTTP_HOST'] . DS . 'img/uncheck.png';
            }

            if (!empty($order->delivered)) {
                $order->delivered_img = 'http://' . $_SERVER['HTTP_HOST'] . DS . 'img/checked.png';
            } else {
                $order->delivered_img = 'http://' . $_SERVER['HTTP_HOST'] . DS . 'img/uncheck.png';
            }
        }            

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
        $userRoleId = $this->User->getUserRoleId($this->Auth->user('id'));
        $allowRoleIds = [ADMIN, SENDER];

        if (!in_array($userRoleId, $allowRoleIds)) {

            $this->Flash->error(__('You are not authorized to access that location'));
            
            return $this->redirect(['action' => 'index']);
        }

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

            $customer = $this->Customers->find('all', [
                'conditions' => [
                    'Customers.phone' => $customerDatas['phone'],
                ],
            ])->first();

            if (empty($customer)) {
                $customer = $this->Customers->newEntity();
            }
            
            $customer = $this->Customers->patchEntity($customer, $customerDatas);

            if (!$this->Customers->save($customer)) {
                Log::info($customer->errors());

                return $this->Flash->error(__('Unable to create/update customer.'));
            }
            // Log::info($customer);

            $latestOrder = $this->model->find('all', [
                'conditions' => [],
                'fields' => [
                    'id',
                    'order_code',
                ],
                'order' => [
                    'id' => 'DESC',
                ],
            ])->first();

            if (empty($latestOrder)) {
                $nextOrderId = '00001';
            } else {
                // Log::info('Origin');
                // Log::info($latestOrder->order_code);
                $nextOrderId = (int)$latestOrder->order_code + 1;
                // Log::info('Increased');
                // Log::info($nextOrderId);
                $nextOrderId = (string)$nextOrderId;

                $nextOrderId = str_pad($nextOrderId, 5, "0", STR_PAD_LEFT);
            }

            // Create order.
            $orderDatas = [
                'order_code' => $nextOrderId,
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

                return $this->Flash->error(__('Unable to create/update order.'));
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

                return $this->Flash->error(__('Unable to create/update product.'));
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

                        return $this->Flash->error(__('Unable to upload file, please try again.'));
                    }
                } else{

                    return $this->Flash->error(__('Unable to upload file, please try again.'));
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

        if (!empty($order)) {

            if (!empty($order->order_date)) {
                $order->order_date = date('Y-m-d', strtotime($order->order_date));
            }            

            if (!empty($order->product->product_photo->path)) {
                $order->product->product_photo->path = 'http://' . $_SERVER['HTTP_HOST'] . DS . $order->product->product_photo->path;
            }        
        }
        $this->set(compact('order'));

        $userRoleId = $this->User->getUserRoleId($this->Auth->user('id'));

        $this->set(compact('userRoleId'));

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
                return $this->Flash->error(__('Unable to create/update customer.'));
            }
            // Log::info($customer);
            // Create order.
            $orderDatas = [
                'order_code' => $customer->phone,
                'customer_id' => $customer->id
            ];

            $userRoleId = $this->User->getUserRoleId($this->Auth->user('id'));
            $allowRoleIds = [ADMIN, SENDER];
            
            if (in_array($userRoleId, $allowRoleIds)) {

                $_orderDatas = [
                    'price' => $this->request->data['product_price'],
                    'quantity' => $this->request->data['product_quantity'],
                    'create_note' => $this->request->data['create_note'],
                    'order_date' => date('Y/m/d H:i:s', strtotime(str_replace('/', '-', $this->request->data['order_date']))),
                ];

                $orderDatas = array_merge($orderDatas, $_orderDatas);
            }

            $order = $this->model->patchEntity($order, $orderDatas);

            if (!$this->model->save($order)) {
                $this->Customers->delete($customer);
                $this->Products->delete($product);
                Log::info($order->errors());

                return $this->Flash->error(__('Unable to create/update order.'));
            }
            $allowRoleIds = [ADMIN, SENDER];

            if (in_array($userRoleId, $allowRoleIds)) {

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

                    return $this->Flash->error(__('Unable to create/update product.'));
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

                            return $this->Flash->error(__('Unable to upload file, please try again.'));
                        }
                    } else{

                        return $this->Flash->error(__('Unable to upload file, please try again.'));
                    }
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
        $userRoleId = $this->User->getUserRoleId($this->Auth->user('id'));
        $allowRoleIds = [ADMIN, SENDER];

        if (!in_array($userRoleId, $allowRoleIds)) {
            $this->Flash->error(__('You are not authorized to access that location'));

            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is('post')) {
            $order = $this->model->find('all', [
                'conditions' => [
                    'Orders.id' => $id,
                ]
            ])->first();

            if (!empty($order)) {
                $order->sent = Time::now();

                if (!$this->model->save($order)) {
                    Log::info($order->errors());

                    return $this->Flash->error(__('Unable to confirm sent.'));
                }

                return $this->redirect(['action' => 'index']);
            }

            return $this->Flash->error(__('Unable to confirm sent.'));
        }
    }

    public function delivered($id) {
        $userRoleId = $this->User->getUserRoleId($this->Auth->user('id'));
        $allowRoleIds = [ADMIN, DELIVER];

        if (!in_array($userRoleId, $allowRoleIds)) {
            $this->Flash->error(__('You are not authorized to access that location'));

            return $this->redirect(['action' => 'index']);
        }

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
                $order->payment_method_id = $this->request->data['payment_method_id'];

                if (!$this->model->save($order)) {
                    Log::info($order->errors());
                    
                    return $this->Flash->error(__('Unable to confirm delivered.'));
                }

                return $this->redirect(['action' => 'index']);
            }

            return $this->Flash->error(__('Unable to confirm delivered.'));
        }
    }
}