<?php
  include './include/inc.header.php';

  $meal_array = Meal::getMealById($_GET['id']);

  $meal = $meal_db->getMealById($_GET['id'])
?>

	<!-- image, price and rating section -->
	<div class="container-fluid pt-5 px-10 row">
		<img class="image_with_shadow col-12 col-lg-6" src="projectImages/<?php echo $meal['image'] ?>" alt="meal1">
    <div class="col-12 col-lg-6">
      <h1 class="red_text"><?php echo $meal['title'] ?></h1>
      <?php echo $meal['price'] ?> SAR
      <p>
      &#11088
      <?php echo $meal['rating'] ?> rating
      <p><?php echo $meal['description'] ?></p>
      <div class="detail_quantity_div">
        <div class="detail_quantity_div__counter">
          <input type="button" class="detail_quantity_div__counter--yellow_box red_text" value="-" onclick="inc_dec_quantity_button('dec')">
          <div class="detail_quantity_div__counter--yellow_box red_text" id="detail_quantity_label">1</div>
          <input type="button" class="detail_quantity_div__counter--yellow_box red_text" value="+" onclick="inc_dec_quantity_button('inc')">
        </div>
        <a class="button red_text" href="javascript:add_to_cart(<?php echo $_GET['id']?>)">add to cart</a>
      </div>
    </div>
  </div>

  <!-- Description - reviews -->
  <div class="container-fluid pt-5 px-10">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li role="presentation">
        <button class="nav-link active red_text" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">Description</button>
      </li>
      <li role="presentation">
        <button class="nav-link red_text" id="pills-reviews-tab" data-bs-toggle="pill" data-bs-target="#pills-reviews" type="button" role="tab" aria-controls="pills-reviews" aria-selected="false" onclick="showReviews(<?php echo $_GET['id']?>)">Reviews</button>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
        <h2 class="red_text">description</h2>
        <p>
          <?php echo $meal['description'] ?>
        </p>

        <h4>Nutrition Facts</h4>
        <table>
          <tr>
            <th colspan="3">Supplement Facts</th>
          </tr>
          <tr>
            <td colspan="3"><strong>Serving Size:</strong><?php echo $meal_array['nutrition']['serving_size'] ?></td>
          </tr>
          <tr>
            <td colspan="3"><strong>Serving Per Container:</strong> <?php echo $meal_array['nutrition']['serving_per_container'] ?></td>
          </tr>
          <tr>
            <th></th>
            <th>Amount Per Serving</th>
            <th>%Daily Value*</th>
          </tr>
          <?php
            foreach($meal_array['nutrition']['facts'] as &$fact){
              echo '<tr>
                <td>'.$fact['item'].'</td>
                <td>'.$fact['amount_per_serving'].'</td>
                <td>'.$fact['daily_value'].' '.$fact['unit'].'</td>
              </tr>';
            }
          ?>
        </table>
        <table>
          <tr>
            <td>* Percent Daily Values are based on a 2,000 calorie diet. Your Daily values may be higher or lower depending on your calorie needs</td>
          </tr>
        </table>
      </div>
      <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
        <h3>Reviews</h3>
        <!-- review -->

        <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner" id="reviews">
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

        <div id="reviews">
        </div>

        <!-- write review -->
        <div>
          <br>
          <input type="button" class="button red_text" value="Add Your Review" id="toggle_review_form_button" onclick="toggle_review_form()">

          <form name="review_form" class="review_form" id="review_form">
            <br>

            <label for="review_image">Image</label>
            <br>
            <input type="file" accept="image/*" id="review_image" name="review_image">
            <br>
            <br>

            <label for="review_rate">Rate the Food</label>
            <br>
            <input type="range" id="review_rate" name="review_rate" min="0" max="5">
            <br>
            <br>

            <label for="review_name">Name</label>
            <input type="text" class="text_input" id="review_name" name="review_name" placeholder="First and Last name" maxlength="30">
            <br>
            <br>

            <label for="review_textarea">Review</label>
            <label class="red_text error_message" id="review_textarea_error_message">Please type yout review</label>
            <textarea class="text_input" placeholder="Type your review here in 500 characters" maxlength="500" id="review_textarea" name="review_textarea" rows="10" cols="30" onkeyup="count_review_characters()"></textarea>

            <div id="textarea_characters_counter">0 / 500</div>
            </br>
            </br>

            <input type="button" onclick="submit_review(<?php echo $_GET['id'] ?>)" class="button white_text" value="Submit">
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php include './include/inc.footer.php';?>
</body>
</html>
