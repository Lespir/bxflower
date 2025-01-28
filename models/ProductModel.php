<?php
require_once 'Model.php';

class ProductModel extends Model {
    public function getProducts($page = 1, $itemsPerPage = ITEMS_PER_PAGE) {
        $offset = ($page - 1) * $itemsPerPage;
        $stmt = $this->db->prepare("
            SELECT p.*, GROUP_CONCAT(pi.url) AS images
            FROM products p
            LEFT JOIN product_images pi ON p.id = pi.product_id
            GROUP BY p.id
            LIMIT :limit OFFSET :offset
        ");
        
        $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        
        // Convert images from comma-separated string to an array
        foreach ($products as &$product) {
            $product['images'] = $product['images'] ? explode(',', $product['images']) : [];
        }
        
        return $products;
    }

    public function getTotalProducts() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM products");
        return (int)$stmt->fetchColumn();
    }

    public function getProduct($id) {
        $stmt = $this->db->prepare("
            SELECT * FROM products 
            WHERE id = :id
        ");
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductImages($productId) {
        $stmt = $this->db->prepare("
            SELECT * FROM product_images 
            WHERE product_id = :product_id
        ");
        
        $stmt->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
