<?php
require_once 'Model.php';

class OrderModel extends Model {
    public function createOrder($data) {
        $data = $this->sanitize($data);
        
        // Fetch product price to calculate total price
        $productModel = new ProductModel();
        $product = $productModel->getProduct($data['product_id']); // Get product details
        
        if (!$product) {
            throw new Exception('Product not found');
        }
    
        $totalPrice = $product['price'] * $data['quantity']; // Calculate total price
        
        $stmt = $this->db->prepare("
            INSERT INTO orders (
                customer_name, 
                phone, 
                address, 
                product_id, 
                quantity, 
                total_price, 
                created_at
            ) VALUES (
                :customer_name,
                :phone,
                :address,
                :product_id,
                :quantity,
                :total_price,
                NOW()
            )
        ");
        
        return $stmt->execute([
            ':customer_name' => $data['customer_name'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':product_id' => $data['product_id'],
            ':quantity' => $data['quantity'],
            ':total_price' => $totalPrice // Pass the calculated total price
        ]);
    }

    public function validateOrderData($data) {
        $errors = [];
        
        if (empty($data['customer_name'])) {
            $errors['customer_name'] = 'Name is required';
        }
        
        if (empty($data['phone'])) {
            $errors['phone'] = 'Phone is required';
        } elseif (!preg_match('/^[0-9]{10}$/', $data['phone'])) {
            $errors['phone'] = 'Invalid phone number format';
        }
        
        if (empty($data['address'])) {
            $errors['address'] = 'Address is required';
        }
        
        return $errors;
    }
}
