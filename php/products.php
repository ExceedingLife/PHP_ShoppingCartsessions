<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
  // Start a new SESSION
   // session_start();

  // connect database object
    include "../objects/database.php";
  // include product object files
    include_once "../objects/product.php";
    include_once "../objects/product_images.php";

//class instances here replace Below
  // get database connection
    $database = new Database();
    $db = $database->getConnection();

  // initialize objects
    $product = new Product($db);
    $product_image = new ProductImage($db);
  // to prevent undefined index
    $action = isset($_GET["action"]) ? $_GET["action"] : "";
  // pagination (if no page is set) default : 1
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
  // Records Per Page
    $recordsPerPage = 2;
    $fromRecordNum = ($recordsPerPage * $page) - $recordsPerPage;

  // set page title
    $page_title = "Products";

  // include page header
    include "header.php";

  // PAGE CONTENTS WILL BE HERE.
    echo '<div class="col-md-12">';
        if($action == "added") {
            echo '<div class="alert alert-info">';
                echo "Product was added to your cart!";
            echo '</div>';
        }
        if($action == "exists") {
            echo '<div class="alert alert-info">';
                echo "Product already exists in your cart!";
            echo '</div>';
        }
    echo '</div>';

  // read all products from database.
    $stmt = $product->read($fromRecordNum, $recordsPerPage);
  // count retrieved products
    $num = $stmt->rowCount();
  // if more than 0 products
    if($num > 0) {
        // needed for paging
        $page_url = "products.php?";
        $total_rows = $product->count();

        // show Products
        include_once "read_products.php";
    } else {
    // Show user no products exists
        echo '<div class="col-md-12">';
            echo '<div class="alert alert-danger">No Products were found.</div>';
        echo '</div>';
    }

  // include page footer
    include "footer.php";

?>
