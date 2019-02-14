<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        // create box
        echo '<div class="col-md-4 mb-2">';
            // product id for javascript
            echo "<div class='product-id d-none'>{$pid}</div>";
                echo "<a href='product.php?id={$pid}' class='product-link'>";
                // select and show product image
                $product_image->product_id=$pid;        //<==== ---  WAS $id
                $stmt_product_image=$product_image->readFirst();

                while ($row_product_image = $stmt_product_image->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="mb-1">';
                        //echo '<img src="../img/{$row_product_image[name]}" class="w-100" />'; //class='w-100-pct'
                         echo '<img src="../img/'.$row_product_image['name'].'" class="w-100" />';
                        // echo '<img src="../img/snowboard-1.jpg" class="w-100" />'; //class='w-100-pct'
                    echo '</div>';
                }
                // product name
                    echo "<div class='product-name mb-1'>{$pdesc}</div>";
                echo '</a>';
                
                // add to cart btn
                echo '<div class="mb-1">';
                    if(array_key_exists($pid, $_SESSION['cart'])) {     //<---- WAS $id
                        echo '<a href="cart.php" class="btn btn-success w-100">'; // w-100-pct
                            echo "Update Cart";
                        echo '</a>';
                    } else {
                        echo "<a href='add_to_cart.php?id={$pid}&page={$page}' class='btn btn-primary w-100'>Add to Cart</a>";
                    }
                echo '</div>';
        echo '</div>';
        //echo '</div>';
    }
    include_once "paging.php";
?>
