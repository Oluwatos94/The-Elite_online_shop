<?php

declare(strict_types=1);
session_start();
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/env/setting.php";

use TeldsShop\App\Routing;

$pageControllerNameSpace = 'TeldsShop\\Controllers\MainPageController';
$cartControllerNameSpace = 'TeldsShop\\Controllers\\CartAction';
$productsControllerNameSpace = 'TeldsShop\\Controllers\\ProductsAction';
$usersControllerNameSpace = 'TeldsShop\\Controllers\\UsersAction';

Routing::path('/', 'get', $pageControllerNameSpace, 'index');
Routing::path('/login', 'get', $usersControllerNameSpace, 'login');
Routing::path('/login', 'post', $usersControllerNameSpace, 'authenticate');
Routing::path('/logout', 'get', $usersControllerNameSpace, 'logout');
Routing::path('/register', 'get', $usersControllerNameSpace, 'index');
Routing::path('/register', 'post', $usersControllerNameSpace, 'path');
Routing::path('/cart', 'get', $cartControllerNameSpace, 'index');
Routing::path('/cart/remove/{id}', 'get', $cartControllerNameSpace, 'delete');
Routing::path('/checkout', 'get', $cartControllerNameSpace, 'checkout');
Routing::path('/thankyou', 'get', $cartControllerNameSpace, 'thankyou');
Routing::path('/notfound', 'get', $pageControllerNameSpace, 'pageNotFound');
Routing::path('/products/all', 'get', $productsControllerNameSpace, 'allProducts');
Routing::path('/product/{id}', 'get', $productsControllerNameSpace, 'index');
Routing::path('/product/{id}', 'post', $cartControllerNameSpace, 'path');

Routing::executePath();
