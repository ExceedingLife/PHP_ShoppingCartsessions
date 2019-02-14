
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

                    <!-- active nav / nav-item active -->
                    <!-- TO-DO: php page checks for active and cart.count -->

                    <li class="nav-item px-lg-4">
                        <a class="nav-link text-uppercase" href="#">Home</a>
                    </li>
                    <li class="nav-item px-lg-4 <?php echo $page_title=='Products'? 'active' : ''; ?>">
                        <a class="nav-link text-uppercase" href="products.php">Products</a>
                    </li>
                    <li class="nav-item px-lg-4 <?php echo $page_title=='Cart'? 'active' : ''; ?>">
                        <a class="nav-link text-uppercase" href="cart.php">
                        <?php $cart_count = count($_SESSION['cart']); ?>
                            Cart<span class="badge badge-light">
                            <?php echo $cart_count; ?></span>
                        </a>

                    </li>
                </ul>
            </div>

        </div>
    </nav>
