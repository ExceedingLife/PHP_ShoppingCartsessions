<?php
  // Product_Image Object Class
    class ProductImage {

        // database connection and table name
        private $pdoConn;
        private $table_name = "product_images";

        // object properties
        public $id;
        public $product_id;
        public $name;
        public $timestamp;

        //constructor
        public function __construct($dbconn) {
            $this->pdoConn = $dbconn;
        }

        // read first product img related to product
        function readFirst() {
            // SELECT query
            $query = "SELECT id, pid, name " .
                     "FROM " . $this->table_name . " " .
                     "WHERE pid = ? " .
                     "ORDER BY name DESC " .
                     "LIMIT 0, 1";
            // prepare query statement
            $stmt = $this->pdoConn->prepare($query);
            // sanitize
            $this->product_id=htmlspecialchars(strip_tags($this->product_id));
            // bind variable as parameter
            $stmt->bindParam(1, $this->product_id);
            // execute query
            $stmt->execute();
            // return values
            return $stmt;
        }

        // read product image for specific product
        function readByProductId() {
            // query
            $query = "SELECT id, pid, name " .
                     "FROM " . $this->table_name . " " .
                     "WHERE pid = ? " .
                     "ORDER BY name DESC";
            // prepare query statement
            $stmt = $this->pdoConn->prepare($query);
            // sanitize
            $this->product_id=htmlspecialchars(strip_tags($this->product_id));
            // bind id variable
            $stmt->bindParam(1, $this->product_id);
            // execute query
            $stmt->execute();
            // return values
            return $stmt;
        }
    }
?>
