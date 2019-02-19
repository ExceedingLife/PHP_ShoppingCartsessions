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
                     ///"ORDER BY pcreated DESC " .
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
            $query = "SELECT pid, pname, pprice, pdesc " .
                     "FROM " . $this->table_name . " " .
                     "WHERE pid IN ({$ids_arr}) " .
                     "ORDER BY pname";
            // prepare query statement
            $stmt = $this->pdoConn->prepare($query);
            // execute query
            $stmt->execute($ids);
            // return values from database
            return $stmt;
        }

        // for reading product for UPDATE
        function readOne(){
            // query
            $query = "SELECT pname, pprice, pdesc " .
                     "FROM " . $this->table_name . " " .
                     "WHERE pid = ? " .
                     "LIMIT 0, 1";
            // prepare query statement
            $stmt = $this->pdoConn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            // bind prod id value
            $stmt->bindParam(1, $this->id);
            // execute query
            $stmt->execute();
            // get row values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // assign retrieved values to object
            $this->name = $row['pname'];
            $this->description = $row['pdesc'];
            $this->price = $row['pprice'];
        }
    }
?>
