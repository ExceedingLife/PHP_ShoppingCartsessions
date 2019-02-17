<?php
session_start();
// get the prodIDs
$id = isset($_GET["id"]) ? $_GET["id"] : "";
$name = isset($_GET["name"]) ? $_GET["name"] : "";
// remove item from array
unset($_SESSION["cart"][$id]);

// redirect pList and tell user
header("Location: cart.php?action=removed&id=" . $id);

?>