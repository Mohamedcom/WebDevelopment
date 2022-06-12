<?php

echo $_POST['itemsIds'];

echo $_POST['totalPrice'];

setcookie('recent-bought', $_COOKIE['cart'], time() + (86400 * 30), '/');
setcookie('cart', '', time() - (86400 * 30), '/');

header('Location: ../index.php');
?>