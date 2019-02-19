<?php
session_start();
// remove items from cart
session_destroy();
// set page title
$page_title = "Thank you";

// HEADER section
include_once "header.php";

echo "<div class='col-md-12'>";
    // tell user the order was placed
    echo "<div class='alert alert-success'>";
        echo "<strong>Your order has been SUCCESSFUL!</strong>" .
             "<br> Thank you for shopping with us.";
    echo "</div>";
    echo "<a href='products.php' class='btn btn-success mb-1'>";
        echo "<span class='glyphicon glyphicon-ok'></span> Return Home";
    echo "</a>";
echo "</div>";

// FOOTER section
include_once "footer.php";
?>