<?php
$_SESSION['cart']=isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
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
    <link rel="stylesheet" href="../css/main.css" />
    <!-- Glyph Icons CSS -->
    <link rel="stylesheet" href="../css/glyphicon.css" />
</head>
<body>
    <header class="container-fluid text-center text-light py-4">
        <div>
            <div class="d-block">
                <img id="headpic" class="rounded-circle" src="../img/Andrew.JPG" />
            </div>
            <div>
                <h1 class="header-text d-inline">PHP Bootstrap4 mySQL Shopping Cart</h1>
                <span class="d-inline text-light2">By Andrew Harkins</span>
            </div>
        </div>
    </header>

    <?php include "navigation.php"; ?>

    <!-- Included Section Content by Page Below -->
    <section id="section-content" class="text-center">
        <div id="contentdiv" class="container rounded contentdiv">
            <div class="row">
                <div class="col-md-12">
                    <div class="pb-2 mt-4 mb-2 border-bottom clearfix">
                        <h2><?php echo isset($page_title) ? "PHP Shopping Cart - " .
                             $page_title : "PHP Shopping Cart - SESSION"; ?></h2>
                    </div>
                </div>

            <!--    
            </div>
        </div>
    </section>
             -->
