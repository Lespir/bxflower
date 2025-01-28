<?php
require_once '../models/ProductModel.php';

class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();
    }

    public function index() {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $products = $this->productModel->getProducts($currentPage);
        $totalProducts = $this->productModel->getTotalProducts();
        $totalPages = ceil($totalProducts / ITEMS_PER_PAGE);

        ob_start();
        include '../views/products/list.php';
        $content = ob_get_clean();
        
        include '../views/layouts/main_template.php';
    }

    public function show() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $product = $this->productModel->getProduct($id);
        $productImages = $this->productModel->getProductImages($id);
    
        if (!$product) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }
    
        ob_start();
        include '../views/products/detail.php';
        $content = ob_get_clean();
        
        include '../views/layouts/main_template.php';
    }
}