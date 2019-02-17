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
        echo "<strong>Your order has been SUCCESSFUL!</strong>
         \nThank you for shopping with us.";
    echo "</div>";
echo "</div>";

// FOOTER section
include_once "footer.php";
?>