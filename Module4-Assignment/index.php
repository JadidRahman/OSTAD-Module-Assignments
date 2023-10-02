<?php
require_once 'Product.php';
require_once 'ProductView.php';
require_once 'ProductController.php';


// Create a Product object
$product = new Product(1, 'T-shirt', 19.99);

// Create a View object
$view = new ProductView();

// Create a Controller object
$controller = new ProductController($product, $view);

// Display product details
$controller->showProductDetails();
