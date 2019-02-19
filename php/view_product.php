<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// start session
session_start();
// object classes
include_once "../objects/database.php";
include_once "../objects/product.php";
include_once "../objects/product_images.php";
// get database connection
$database = new Database();
$db = $database->getConnection();
// initialize objects
$product = new Product($db);
$product_image = new ProductImage($db);
// get productID
$id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: missing ID.");
// set the id as product id property
$product->id = $id;
// read a single product record
$product->readOne();
// set page title
$page_title = $product->name;
// product thumbnail here
// set product image id
$product_image->product_id = $id;
// read all product image info
$stmt_product_image = $product_image->readByProductId();
$num_product_image = $stmt_product_image->rowCount();

// HEADER content
include_once "header.php";

// PRODUCT content below
echo "<div class='col-md-1'>";
    if($num_product_image > 0) {
        while($row = $stmt_product_image->fetch(PDO::FETCH_ASSOC)) {
            $product_image_name = $row['name'];
            $source = "../img/{$product_image_name}";
            echo "<img src='{$source}' class='product-img-thumbnail w-100' 
                   data-img-id='{$row['id']}' />";
        }
    } else {
        echo "No Image.";
    }
echo "</div>";

//p image/images here
echo "<div class='col-md-4' id='product-img'>";
    // read all product images
    $stmt_product_image = $product_image->readByProductId();
    $num_product_image = $stmt_product_image->rowCount();
    // if more than 0 loop
    if($num_product_image > 0) {
        $x = 0;
        while($row = $stmt_product_image->fetch(PDO::FETCH_ASSOC)) {
            // get image name and url
            $product_image_name = $row['name'];
            $source="../img/{$product_image_name}";
            $show_product_image = $x==0 ? "d-block" : "d-none";
            echo "<a href='{$source}' target='_blank' id='product-img-{$row['id']}' 
                   class='product-img '>";
                echo "<img src='{$source}' style='width:300px; height:300px;' />"; // '{$show_product_image}'
            echo "</a>";
            $x++;
        }
    } else { echo "No Images."; }
echo "</div>";

// p details here
echo "<div class='col-md-5'>";
    echo "<div class='product-detail'><b>Price:</b></div>";
    echo "<h5 class='mb-1 price-description'>&#36;" . 
           number_format($product->price, 2, '.', ',') . "</h5>";
    echo "<div class='product-detail'><b>Product description:</b></div>";
    echo "<div class='mb-1'>";
        // make html description altough not in database using pdesc
        $page_description = htmlspecialchars_decode($product->description);
        echo $page_description;
    echo "</div>";
    echo "<div class='product-detail'><b>Product category:</b></div>";
    echo "<div class='mb-1'>{$product->category_name}</div>";
echo "</div>";

echo "<div class='col-md-2'>";
    // if prod in cart
    if(array_key_exists($id, $_SESSION['cart'])) {
        echo "<div class='mb-1'>This product is already in your cart</div>";
        echo "<a href='cart.php' class='btn btn-success w-100'>";
            echo "Update Cart";
        echo "</a>";
    } else {
        // product not added to cart
        echo "<form class='add-to-cart-form'>";
            // product id
            echo "<div class='product-id d-none'>{$id}</div>";
            echo "<div class='mb-1'>Quantity:</div>";//f-w-b
            echo "<input type='number' value='1' class='form-control mb-1 
                   cart-quantity' min='1' />";
            // add to cart btn
            echo "<button type='submit' class='btn btn-primary add-to-cart mb-1'>";
                echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
            echo "</button>";
        echo "</form>";
    }
echo "</div>";

// FOOTER content
include_once "footer.php";

?>