<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'bx_market');
define('DB_PASS', '1402');
define('DB_NAME', 'ecommerce');

define('BASE_URL', '/');
define('ITEMS_PER_PAGE', 12);

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session start
session_start();

// Database connection
function getDbConnection() {
    try {
        $conn = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        return $conn;
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}