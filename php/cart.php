<?php
  // Start session
    session_start();
  // database config
    include "../objects/database.php";
  // include objects
    include_once "../objects/product.php";
    include_once "../objects/product_images.php";
  // get database connection
    $database = new Database();
    $db = $database->getConnection();
  // initialize objects
    $product = new Product($db);
    $product_image = new ProductImage($db);
  // set title page
    $page_title = "Cart";
  // include page header
    include "header.php";
    
  // contents for cart below
    $action = isset($_GET["action"]) ? $_GET["action"] : "";

    echo '<div class="col-md-12">';
        if($action == "removed") {
            echo '<div class="alert alert-danger">';
                echo "Product was removed from your cart";
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
            echo '</div>';
        } else if($action == "quality_updated") {
            echo '<div class="alert alert-info">';
                echo "Product quantity was updated";
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
            echo '</div>';
        }
    echo '</div>';

    if(count($_SESSION["cart"]) > 0) {
        // get productID's
        $ids = array();
        foreach($_SESSION["cart"] as $id => $value) {
            array_push($ids, $id);
        }
        $stmt = $product->readByIds($ids);
        $total = 0;
        $item_count = 0;

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $quantity = $_SESSION["cart"][$id]["quantity"];
            $sub_total = $pprice * $quantity;

            echo '<div class="container">';
                echo '<div class="row cart-row">';
                    echo '<div class="col-md-8">';
                        echo "<div class='product-name mb-1'><h4>{$pdesc}</h4></div>";
                        // update quantity
                        echo '<form class="update-quantity-form">';
                            echo "<div class='product-id d-none'>{$pid}</div>";//style=;"

                            echo '<div class="input-group">';
                                echo "<input type='number' name='quantity' value='{$quantity}'
                                       class='form-control cart-quantity col-3' min='1' />";
                                echo '<span class="input-group-btn">';
                                    echo '<button class="btn btn-secondary update-quantity" type="submit">Update</button>';
                                echo '</span>';
                                // delete from cart
                                echo "<a href='remove_from_cart.php?id={$pid}' role='button' 
                                       class='btn btn-default btn-danger mx-2'>";
                                    echo 'Delete';
                                echo '</a>';
                            echo '</div>';
                        echo '</form>';
                    echo '</div>';

                    echo '<div class="col-md-4">';
                        echo '<h4>&#36;' . number_format($pprice, 2, '.', ',') . '</h4>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

            $item_count += $quantity;
            $total += $sub_total;
        }
        
        echo '<div class="col-md-8"></div>';
        echo '<div class="col-md-4">';
            echo '<div class="cart-row">';
                echo "<h4 class='mb-1'>Total ({$item_count} items)</h4>";
                echo '<h4>&#36;' . number_format($total, 2, '.', ',') . '</h4>';
                echo '<a href="checkout.php" class="btn btn-success mb-1">';
                    echo '<span class="glyphicon glyphicon-shopping-cart"></span>Proceed to Checkout';
                echo '</a>';
            echo '</div>';
        echo '</div>';
    }
// no products were added to cart
else {
    echo '<div class="col-md-12">';
        echo '<div class="alert alert-danger">';
            echo 'No products found in your cart!';
        echo '</div>';
    echo '</div>';
}
  // include page footer
    include "footer.php";

?>