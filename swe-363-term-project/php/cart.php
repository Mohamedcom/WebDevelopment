<?php

$id = $_GET['id'];
$quantity = $_GET['quantity'];
$back = $_GET['back'];


$cartContent;
if(isset($_COOKIE['cart'])) {
  $cartContent = json_decode($_COOKIE['cart']);
  $cartContent->$id = $cartContent->$id + $quantity;
}

setcookie('cart', json_encode($cartContent), time() + (86400 * 30), '/');

header('Location: '.$back);

?>
