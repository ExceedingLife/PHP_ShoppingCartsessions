<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// start SESSION
session_start();
  // db connection & object classes
    include_once "objects/database.php";
    include_once "objects/product.php";
    include_once "objects/product_images.php";
// object instances
$_SESSION['cart']=isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$product_image = new ProductImage($db);
$action = isset($_GET["action"]) ? $_GET["action"] : "";
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$recordsPerPage = 1;
$recordNumber = ($recordsPerPage * $page) - $recordsPerPage;
$page_title = "index-test";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($page_title) ? "PHP_Cart-".$page_title : "PHP_ShoppingCart";?></title>
    <!-- BootStrap 4 CDN CSS external link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="css/main.css" />
    <!-- Glyph Icons CSS -->
    <link rel="stylesheet" href="css/glyphicon.css" />
</head>
<body>
    <header class="container-fluid text-center text-light py-4">
        <div>
            <div class="d-block">
                <img id="headpic" class="rounded-circle" src="img/Andrew.JPG" />
            </div>
            <div>
                <h1 class="header-text d-inline">PHP Bootstrap4 mySQL Shopping Cart</h1>
                <span class="d-inline text-light2">By Andrew Harkins</span>
            </div>
        </div>
    </header>
    <!-- Navigation Bar py-lg-4 -->
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Harkins Shopping Cart</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navCart"
                aria-controls="navCart" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navCart">
                <ul class="navbar-nav mx-auto"><!-- TEST MX-AUTOO-->
                    <li class="nav-item px-lg-4 <?php echo $page_title=='index-test' ? 'active' : ''; ?>">
                        <a class="nav-link text-uppercase" href="#">Home</a>
                    </li>
                    <li class="nav-item px-lg-4 <?php echo $page_title=='Products'? 'active' : ''; ?>">
                        <a class="nav-link text-uppercase" href="php/products.php">Products</a>
                    </li>
                    <li class="nav-item px-lg-4 <?php echo $page_title=='Cart'? 'active' : ''; ?>">
                        <a class="nav-link text-uppercase" href="php/cart.php">
                        <?php $cart_count = count($_SESSION['cart']); ?>
                            Cart<span class="badge badge-light">
                            <?php echo $cart_count; ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Included Section Content by Page Below -->
    <section id="section-content" class="text-center">
        <div id="contentdiv" class="container rounded contentdiv">
            <div class="row">
                <div class="col-md-12">
                    <div class="pb-2 mt-4 mb-2 border-bottom clearfix">
                        <h2><?php echo isset($page_title) ? "PHP <b>TEST</b> Cart - " .
                             $page_title : "PHP Shopping Cart - TEST PAGE"; ?></h2>
                    </div>
                </div>
                <!-- Page CONTENT is here. -->
<?php
    echo '<div class="col-md-12">';
        if($action=="added") {
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
    $stmt = $product->read($recordNumber, $recordsPerPage);
    $num = $stmt->rowCount();
if($num > 0){
    $page_url = "products.php?";
    $total_rows = $product->count();
    // include read products show -----
    if(!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        // create box
        echo '<div class="col-md-4 mb-2">';
            // product id for javascript
            echo "<div class='product-id d-none'>{$pid}</div>";
                echo "<a href='product.php?id={$pid}' class='product-link'>";
                // select and show product image
                $product_image->product_id=$pid;
                $stmt_product_image=$product_image->readFirst();
                while($row_product_image = $stmt_product_image->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="mb-1">';
                        echo '<img src="img/'.$row_product_image['name'].'" class="w-100" />';
                    echo '</div>';
                }
                // product name
                echo "<div class='product-name mb-1'>{$pdesc}</div>";
            echo '</a>';
          // ADD TO CART BTN
            echo '<div class="mb-1">';
            if(array_key_exists($pid, $_SESSION["cart"])) {
                echo '<a href="cart.php" class="btn btn-success w-100">';
                    echo 'UPDATE CART';
                echo '</a>';
            } else {
                echo "<a href='add_to_cart.php?id={$pid}&page={$page}' 
                       class='btn btn-primary w-100'>Add to Cart</a>";
            }
            echo '</div>';
        echo '</div>';
    }
} else {
    echo '<div class="col-md-12">';
        echo '<div class="alert alert-danger">No Products were found.</div>';
    echo '</div>';
}
?>









            </div>            <!-- </div> .="row" ABOVE -->
        </div>        <!-- </div> #="contentdiv" ABOVE -->
    </section>    <!-- </section> #="section-content" ABOVE -->
<!-- BootStrap 4 CDN JavaScript -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<!-- Custom JavaScript Script -->
<script type="text/javascript">
    // $(document).ready(function() {
    //     // add button listener
    //     $('.add-to-cart-form').on("submit", function() {
    //         // information in table / single product layout
    //         var id = $(this).find("product-id").text();
    //         var quantity = $(this).find(".cart-quantity").val();
    //         // redirect to add_to_cart.php, with parameter values
    //         window.location.href = "add_to_cart.php?id=" + id + "&quantity=" + quantity;
    //         return false;
    //     });
    // });
</script>
</body>
</html>