<?php
session_start();
// connect database / Objects
include "../objects/database.php";
 //include_once " ../objects/product.php";
include_once "../objects/product.php";
include_once "../objects/product_images.php";
// get db connection
$database = new Database();
$db = $database->getConnection();
// initialize objects
$product = new Product($db);
$product_image = new ProductImage($db);
// set page title
$page_title = "Checkout";
// HEADER
include "header.php";

if(count($_SESSION["cart"]) > 0) {
    // get the prodIDs
    $ids = array();
    foreach($_SESSION["cart"] as $id => $value) {
        array_push($ids, $id);
    }

    $stmt = $product->readByIds($ids);
    $total = 0;
    $item_count = 0;

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $quantity = $_SESSION["cart"][$pid]["quantity"];
        $sub_total = $pprice * $quantity;

        echo "<div class='container'>";
            echo "<div class='row cart-row'>";
                echo "<div class='col-md-9 text-justify'>";
                    echo "<div class='product-name mb-1'><h4>{$pdesc}</h4></div>";
                    echo $quantity > 1 ? "<div>{$quantity} items</div>"
                        : "<div>{$quantity} item</div>";
                echo "</div>";
                echo "<div class='col-md-3'>";
                    echo "<h4>&#36;". number_format($pprice, 2, '.', ',') ."</h4>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
        $item_count += $quantity;
        $total += $sub_total;
    }

    echo "<div class='col-md-12 text-center'>";
        echo "<div class='cart-row'>";
            if($item_count > 1) {
                echo "<h4 class='mb-1'>Total ({$item_count} items)</h4>";
            } else {
                echo "<h4 class='mb-1'>Total ({$item_count} item)</h4>";
            }
            echo "<h4>&#36;". number_format($total, 2, '.', ',') ."</h4>";
            echo "<a href='place_order.php' class='btn btn-lg btn-success mb-1'>";
                echo "<span class='glyphicon glyphicon-shopping-cart'></span> Place Order";
            echo "</a>";
        echo "</div>";
    echo "</div>";
    
} else {
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-danger'>";
            echo "No Products found in your cart";
        echo "</div>";
    echo "</div>";
}

include "footer.php";
?>