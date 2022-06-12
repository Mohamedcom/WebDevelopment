<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Challenge</title>

  <link rel="stylesheet" href="/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400&family=Roboto&display=swap" rel="stylesheet">

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="app.js?v=1"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>

<body>
<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="php/order.php">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cart Content</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php
					include './php/meal.php';
					include './php/meal_db.php';

					$meal_db = new Meal_db;

					if(isset($_COOKIE['cart'])) {
						$cartContent = json_decode($_COOKIE['cart']);
					}else{
						$cartContent = [];
					}
          $cartTotalQuantity = 0;
          $cartTotalPrice = 0;
          $itemsIds = '';

          if(isset($_COOKIE['cart'])){
            echo '<div class="row">
                    <div class="col">Item</div>
                    <div class="col">Price</div>
                    <div class="col">Quantity</div>
                  </div>';
            foreach ($cartContent as $key => $value) {
              $itemsIds = $itemsIds.$key.',';
              $currentMeal = $meal_db->getMealById($key);
              $cartTotalQuantity += $value;
              $cartTotalPrice += $value * $currentMeal['price'];
              echo '<div class="row">
                  <div class="col">'.$currentMeal['title'].'</div>
                  <div class="col">'.$currentMeal['price'].'</div>
                  <div class="col">'.$value.'</div>
                </div>';
            }
            echo '<div class="row">
                    <div class="col">Total</div>
                    <div class="col">'.$cartTotalPrice.'</div>
                    <div class="col">'.$cartTotalQuantity.'</div>
                  </div>';

            echo '<input style="display:none;" name="itemsIds" value="'.$itemsIds.'"/>';
            echo '<input style="display:none;" name="totalPrice" value="'.$cartTotalPrice.'"/>';
          }else{
            echo 'Your cart is empty';
          }
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="button button-red" data-bs-dismiss="modal">Close</button>
            <input
            <?php
              if($cartTotalQuantity == 0){
                echo 'disabled';
              }
            ?>
            type="submit" class="button" value="Order now"/>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- navigation bar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-navbar">
  <div class="container-fluid mx-auto justify-content-lg-center">
    <a class="navbar-brand" href="#">
      <img src="/projectImages/logo-White.svg" class="nav-logo" alt="logo"/>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" style="flex-grow: 0;" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link px-3 py-3" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 py-3" href="#menu">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 py-3" href="#gallery">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 py-3" href="#testimonials">Testimonials</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 py-3" href="#contactUs">Contact Us</a>
        </li>
        <li class="nav-item nav-item--red">
          <a class="nav-link nav-link--red px-3 py-3" href="index.php">Search</a>
        </li>
        <li class="nav-item nav-item--red">
          <a class="nav-link nav-link--red px-3 py-3" href="index.php">Profile</a>
        </li>
        <li class="nav-item nav-item--red">
          <a class="nav-link nav-link--red px-3 py-3" data-bs-toggle="modal" data-bs-target="#cartModal">Cart <div class="cart_items_quantity red_text">
          <?php echo $cartTotalQuantity ?>
          </div></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
