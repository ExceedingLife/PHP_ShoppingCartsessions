<?php
// mySQL database config class - PHP_Cartsess
class Database {
    // database credentials
    private $server = "localhost";
    private $dbname = "php_cart_session";
    private $username = "root";
    private $password = "password";
    public $pdoConn;

    // Get database connection function
    public function getConnection() {

        $this->pdoConn = null;

        try {
            $this->pdoConn = new PDO("mysql:host=" . $this->server . ";dbname=" .
                    $this->dbname, $this->username, $this->password);
            $this->pdoConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $ex) {

            die("Connection Error: " . $ex->getMessage());
        }
        return $this->pdoConn;
    }
}
