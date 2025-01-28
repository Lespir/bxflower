<?php
require_once '../models/OrderModel.php';

class OrderController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
    }

    public function create() {
        $productModel = new ProductModel(); // Instantiate ProductModel
        $productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $product = $productModel->getProduct($productId); // Use ProductModel to get the product
    
        if (!$product) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        $quantity = 1;
    
        ob_start();
        include '../views/orders/form.php';
        $content = ob_get_clean();
        
        include '../views/layouts/main_template.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->orderModel->validateOrderData($_POST);
            if (empty($errors)) {
                $this->orderModel->createOrder($_POST);
                header('Location: /products');
                exit;
            }
        }
        // If there are errors, show the form again
        $this->create();
    }
}