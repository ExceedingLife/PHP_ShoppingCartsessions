<?php 
  // start session
    session_start();

  // get product id 
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

  // make quantity min of 1
    $quantity = $quantity <= 0 ? 1 : $quantity;

  // add new item on array
    $cart_item = array('quantity' => $quantity);

  // check if cart session was created
  // if NOT create session array
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
  // check if item is in array
    if(array_key_exists($id, $_SESSION['cart'])) {
      // redirect to product list and tell user added to cart
      header("Location: products.php?action=exists&id=" . $id . "&page=" . $page);
    } else {
      // else add item to array
      $_SESSION['cart'][$id]=$cart_item;
      // redirect to product list and tell user added to cart 
      header("Location: products.php?action=added&page=" . $page);
    }
?>