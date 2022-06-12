<?php
include './include/inc.header.php';

function meal_card($meal, $buy_again){
  $label = 'Add to cart';
  if($buy_again){
    $label = 'Buy Again';
  }
  return '<div class="meal_card col-12 col-md-4 col-lg-3">
      <a href="detail.php?id='.$meal['id'].'">
        <img src="projectImages/'.$meal['image'].'" style="width:  100%;" alt="'.$meal['image'].'"/>
        <div class="meal_card--text">
          <p>&#11088; '.$meal['rating'].' rating</p>
          <b><strong>'.$meal['title'].'</strong></b>
          <p>Some description</p>
          <p>
            <a class="button white_text" onclick="add_to_cart('.$meal['id'].', true)">'.$label.'</a>
            '.$meal['price'].' SAR
          </p>
        </div>
      </a>
    </div>';
}

?>

	<div class="party_time row justify-content-around px-10 container-fluid m-0">
		<h1 class="col-12">Party Time</h1>
		<h2 class="col-12 col-sm-6">Buy any 2 Burgers and get 1.5L Perpsi Free</h3>
    <input type="button"  class="button red_text col-4 col-md-2 col-lg-1" value="Order now"/>
	</div>


  <?php

    if(isset($_COOKIE['recent-bought'])){
      echo '<!-- recent bought section -->
        <div class="pt-5">
          <h2 class="red_text center_text">Your Recent Bought Products</h2>
          <div class="row gx-0 px-10">';

      $recent_bought = json_decode($_COOKIE['recent-bought']);
      foreach ($recent_bought as $key => $value) {
        $currentMeal = $meal_db->getMealById($key);
        echo meal_card($currentMeal, true);
      }

      echo '</div>
        </div>';
    }
  ?>


	<!-- menu section -->
	<div id="menu" class="pt-5">
    <h2 class="red_text center_text">Want To Eat</h2>
    <p class="center_text">Try our most delicious food and usually take minutes to deliver</p>
    <ul class = "menu__ul">
      <li>pizza</li>
      <li>fast food</li>
      <li>cupcake</li>
      <li>sandwich</li>
      <li>spaghetti</li>
      <li>burger</li>
      </ul>
    <div class="menu__yellow container-fluid">
      <div class="row gx-0">
        <img src="projectImages/delivery.png" alt="delivery" class="col-12 col-lg-6 h-auto"/>
        <div class="col-12 col-lg-6 align-self-center">
          <div class="red_triangle p-5">
            <h2>
              We guarantee 30 minutes delivery
            </h2>
          </div>
          <p class="text-center">if your are having a meeting, working late at night and need an extra push</p>
        </div>
      </div>
    </div>
  </div>

  <!-- gallery section -->
  <div id="gallery" class="container-fluid pt-5">
    <h2 class="red_text center_text">our most popular recipes</h2>
    <p class="center_text">Try our most delicious food and usually take minutes to deliver</p>

    <div class="row gx-0 px-10">
    <?php
      $meals = $meal_db->getAllMeals();

      foreach ($meals as $meal) {
        echo meal_card($meal, false);
      }
    ?>

    </div>

  </div>

  <!-- testimonials section -->
  <div id="testimonials" class="container-fluid pt-5 px-10">
    <h2 class="red_text center_text">clients testimonials</h2>
    <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="row">
            <img src="projectImages/man-eating-burger.png" class="col-12 col-lg-6 h-auto" alt="man-eating-burger">
            <div class="col-12 col-lg-6 align-self-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque ullam deserunt laborum, laboriosam veritatis quibusdam blanditiis dolor exercitationem velit commodi quae assumenda incidunt voluptas. Corporis ex nulla repellendus ullam nihil!</div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="row">
            <img src="projectImages/man-eating-burger.png" class="col-12 col-lg-6 h-auto" alt="man-eating-burger">
            <div class="col-12 col-lg-6 align-self-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque ullam deserunt laborum, laboriosam veritatis quibusdam blanditiis dolor exercitationem velit commodi quae assumenda incidunt voluptas. Corporis ex nulla repellendus ullam nihil!</div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="row">
            <img src="projectImages/man-eating-burger.png" class="col-12 col-lg-6 h-auto" alt="man-eating-burger">
            <div class="col-12 col-lg-6 align-self-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque ullam deserunt laborum, laboriosam veritatis quibusdam blanditiis dolor exercitationem velit commodi quae assumenda incidunt voluptas. Corporis ex nulla repellendus ullam nihil!</div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <?php include './include/inc.footer.php';?>
</body>
</html>
