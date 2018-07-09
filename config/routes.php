<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    $routes->scope('/', ['controller' => 'Orders'], function($routes) {
        $routes->connect('/', ['action' => 'index']);
        $routes->connect('/:id', ['action' => 'index'], ['pass' => ['id']]);
    });

    $routes->scope('/searchs', ['controller' => 'Searchs'], function($routes) {
        $routes->connect('/', ['action' => 'index']);
    });

	$routes->scope('/customers', ['controller' => 'Customers'], function($routes) {
        $routes->connect('/', ['action' => 'index']);
        $routes->connect('/create', ['action' => 'create']);
        $routes->connect('/view/:id', ['action' => 'view'], ['pass' => ['id']]);
        $routes->connect('/delete/:id', ['action' => 'delete'], ['pass' => ['id']]);
        $routes->connect('/update/:id', ['action' => 'update'], ['pass' => ['id']]);
    });

	$routes->scope('/orders', ['controller' => 'Orders'], function($routes) {
        $routes->connect('/:id', ['action' => 'index'], ['pass' => ['id']]);
        $routes->connect('/create', ['action' => 'create']);
        $routes->connect('/view/:id', ['action' => 'view'], ['pass' => ['id']]);
        $routes->connect('/delete/:id', ['action' => 'delete'], ['pass' => ['id']]);
        $routes->connect('/update/:id', ['action' => 'update'], ['pass' => ['id']]);

        $routes->connect('/sent/:id', ['action' => 'sent'], ['pass' => ['id']]);
        $routes->connect('/delivered/:id', ['action' => 'delivered'], ['pass' => ['id']]);
    });

    $routes->scope('/products', function($routes) {
        $routes->scope('/categories', ['controller' => 'ProductCategories'], function($routes){
            $routes->connect('/', ['action' => 'index']);
            $routes->connect('/create', ['action' => 'create']);
            $routes->connect('/view/:id', ['action' => 'view'], ['pass' => ['id']]);
            $routes->connect('/delete/:id', ['action' => 'delete'], ['pass' => ['id']]);
            $routes->connect('/update/:id', ['action' => 'update'], ['pass' => ['id']]);
        });

        $routes->scope('/', ['controller' => 'Products'], function($routes){
            $routes->connect('/', ['action' => 'index']);
            $routes->connect('/create', ['action' => 'create']);
            $routes->connect('/view/:id', ['action' => 'view'], ['pass' => ['id']]);
            $routes->connect('/delete/:id', ['action' => 'delete'], ['pass' => ['id']]);
            $routes->connect('/update/:id', ['action' => 'update'], ['pass' => ['id']]);
        });

        $routes->scope('/photos', ['controller' => 'ProductPhotos'], function($routes){
            $routes->connect('/', ['action' => 'index']);
            $routes->connect('/create', ['action' => 'create']);
            $routes->connect('/view/:id', ['action' => 'view'], ['pass' => ['id']]);
            $routes->connect('/delete/:id', ['action' => 'delete'], ['pass' => ['id']]);
            $routes->connect('/update/:id', ['action' => 'update'], ['pass' => ['id']]);
        });
    });


    $routes->fallbacks(DashedRoute::class);
});
