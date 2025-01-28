<?php
require_once '../config/config.php';

class Model {
    protected $db;

    public function __construct() {
        $this->db = getDbConnection();
    }

    protected function sanitize($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->sanitize($value);
            }
        } else {
            $data = htmlspecialchars(strip_tags(trim($data)));
        }
        return $data;
    }
}