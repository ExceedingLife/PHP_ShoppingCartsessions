<?php
    // Product Object Class
    class Product {

        // database connection and table name
        private $pdoConn;
        private $table_name = "products";

        // object properties
        public $id;
        public $name;
        public $description;
        public $price;
        public $category_id;
        public $category_name;
        public $timestamp;

        // constructor
        public function __construct($dbconn) {
            $this->pdoConn = $dbconn;
        }

        // read all products
        function read($fromRecordNum, $recordsPerPage) {
            // sql SELECT *
            $query = "SELECT pid, pname, pdesc, pprice " .
                     "FROM " . $this->table_name .
                     //"ORDER BY pcreated DESC " .
                     " LIMIT ?, ?";
            // prepare query statement
            $stmt = $this->pdoConn->prepare($query);
            // bind variables to prepared statements as parameters
            $stmt->bindParam(1, $fromRecordNum, PDO::PARAM_INT);
            $stmt->bindParam(2, $recordsPerPage, PDO::PARAM_INT);
            // execute query
            $stmt->execute();
            // return values
            return $stmt;
        }

        // used for paging products 
        public function count() {
            // query to count all product records
            $query = "SELECT count(*) FROM " . $this->table_name;
            // prepare query statement
            $stmt = $this->pdoConn->prepare($query);
            // execute query
            $stmt->execute();
            // get row value
            $rows = $stmt->fetch(PDO::FETCH_NUM);
            // return count
            return $rows[0];
        }

        // read all products by ids
        public function readByIds($ids) {
            $ids_arr = str_repeat('?,', count($ids)-1) . '?';
            // query to select producsts
            $query = "SELECT pid, pname, pprice" .
                     "FROM " . $this->table_name . 
                     "WHERE pid IN ({$ids_arr}) " .
                     "ORDER BY pname";
            // prepare query statement
            $stmt = $this->pdoConn->prepare($query);
            // execute query
            $stmt->execute($ids);
            // return values from database
            return $stmt;
        }
    }
?>
