<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Log\Log;

class SearchsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('ProductCategory');
        $this->loadComponent('DeliveryMethod');
    }

    private function orderSearch($conditions) {
        
    }

    public function index($page = 0) {
    	$productCategories = $this->ProductCategory->list();
        $this->set(compact('productCategories'));

        $deliveryMethods = $this->DeliveryMethod->list();
        $this->set(compact('deliveryMethods'));

        if ($this->request->is('post')) {
            // Search by order.
        	$orderConditions = [];

        	if (!empty($this->request->data['order_no'])) {
        		$_conditions = [
        			'Orders.order_code' => $this->request->data['order_no'],
        		];

        		$orderConditions = array_merge($orderConditions, $_conditions);
        	}

            if (!empty($this->request->data['product_price'])) {
                $_conditions = [
                    'Orders.price' => $this->request->data['product_price'],
                ];

                $orderConditions = array_merge($orderConditions, $_conditions);
            }

            if (!empty($this->request->data['product_quantity'])) {
                $_conditions = [
                    'Orders.quantity' => $this->request->data['product_quantity'],
                ];

                $orderConditions = array_merge($orderConditions, $_conditions);
            }

            if (!empty($this->request->data['order_date'])) {
                $_conditions = [
                    'Orders.order_date' => date('Y/m/d', strtotime(str_replace('/', '-', $this->request->data['order_date']))),
                ];

                $orderConditions = array_merge($orderConditions, $_conditions);
            }

            // Search by customer.
            $customerConditions = [];

            if (!empty($this->request->data['customer_name'])) {
                $_conditions = [
                    'Customers.name LIKE' => '%' . $this->request->data['customer_name'] . '%',
                ];

                $customerConditions = array_merge($customerConditions, $_conditions);
            }

            if (!empty($this->request->data['customer_nick_name'])) {
                $_conditions = [
                    'Customers.nickname LIKE' => '%' . $this->request->data['customer_nick_name'] . '%',
                ];

                $customerConditions = array_merge($customerConditions, $_conditions);
            }

            if (!empty($this->request->data['customer_phone'])) {
                $_conditions = [
                    'Customers.phone LIKE' => '%' . $this->request->data['customer_phone'] . '%',
                ];

                $customerConditions = array_merge($customerConditions, $_conditions);
            }

            if (!empty($this->request->data['customer_address'])) {
                $_conditions = [
                    'Customers.address LIKE' => '%' . $this->request->data['customer_address'] . '%',
                ];

                $customerConditions = array_merge($customerConditions, $_conditions);
            }

            if (!empty($customerConditions)) {
                $this->loadModel('Customers');
                $customers = $this->Customers->find('all', [
                    'conditions' => $customerConditions,
                ])->toArray();

                if (!empty($customers)) {
                    $customerId = [];

                    foreach ($customers as $customer) {
                        $customerId[] = $customer->id;
                    }

                    if (!empty($customerId)) {
                        $_conditions = [
                            'Orders.customer_id IN' => $customerId,
                        ];

                        $orderConditions = array_merge($orderConditions, $_conditions);
                    }                        
                }
            }

            // Search by product.
            $productConditions = [];

            if (!empty($this->request->data['product_size'])) {
                $_conditions = [
                    'Products.size' => $this->request->data['product_size'],
                ];

                $productConditions = array_merge($productConditions, $_conditions);
            }

            if (!empty($this->request->data['product_name'])) {
                $_conditions = [
                    'Products.name LIKE' => '%' . $this->request->data['product_name'] . '%',
                ];

                $productConditions = array_merge($productConditions, $_conditions);
            }

            if (!empty($productConditions)) {
                $this->loadModel('Products');
                $products = $this->Products->find('all', [
                    'conditions' => $productConditions,
                    'contain' => [
                        'Orders'
                    ],
                ])->toArray();

                if (!empty($products)) {
                    $orderIds = [];

                    foreach ($products as $product) {
                        $orderIds[] = $product->order->id;                        
                    }

                    if (!empty($orderIds)) {
                        $_conditions = [
                            'Orders.id IN' => $orderIds,
                        ];

                        $orderConditions = array_merge($orderConditions, $_conditions);
                    }                        
                }
            }

            // Search by product category.
            $categoryConditions = [];

            if (!empty($this->request->data['product_category_id'])) {
                $_conditions = [
                    'ProductCategories.id' => $this->request->data['product_category_id'],
                ];

                $categoryConditions = array_merge($categoryConditions, $_conditions);
            }

            if (!empty($categoryConditions)) {
                $this->loadModel('ProductCategories');
                $categories = $this->ProductCategories->find('all', [
                    'conditions' => $categoryConditions,
                    'contain' => [
                        'Products' => [
                            'Orders',
                        ],
                    ],
                ])->toArray();

                if (!empty($categories)) {
                    $orderIds = [];

                    foreach ($categories as $category) {
                        foreach ($category->products as $product) {
                            $orderIds[] = $product->order->id;
                        }                                                    
                    }

                    if (!empty($orderIds)) {
                        $_conditions = [
                            'Orders.id IN' => $orderIds,
                        ];

                        $orderConditions = array_merge($orderConditions, $_conditions);
                    }                        
                }
            }

            // Search by carrier.
            $carrierConditions = [];

            if (!empty($this->request->data['delivery_method_id'])) {
                $_conditions = [
                    'Orders.delivery_method_id' => $this->request->data['delivery_method_id'],
                ];
                $orderConditions = array_merge($orderConditions, $_conditions);
            }

            if (!empty($this->request->data['carrier'])) {
                $_conditions = [
                    'Orders.delivery_name' => $this->request->data['carrier'],
                ];
                $orderConditions = array_merge($orderConditions, $_conditions);
            }

            if (!empty($orderConditions)) {
                $this->loadModel('Orders');
                $_page = !empty($page) ? $page : PAGE;
                $orders = $this->Orders->find('all', [
                    'conditions' => $orderConditions,
                    'contain' => [
                        'Customers',
                        'Products' => [
                            'ProductPhotos',
                            'ProductCategories'
                        ],
                    ],
                    'limit' => LIMIT,
                    'page' => $_page,
                ])->toArray();
                $this->set('orders', $orders);
                $total = count($orders);
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

                return $this->render('/Searchs/result');
            }                
        }
    }
}