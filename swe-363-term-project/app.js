function add_to_cart(id, onlyOne){
  var quantity;
  if(onlyOne){
    quantity = 1;
  }else{
    quantity = $('#detail_quantity_label').html();
  }
  window.location.href = `php/cart.php?id=${id}&quantity=${quantity}&back=${encodeURIComponent(window.location.href)}`;
}

function inc_dec_quantity_button(action){
  var quantity = $('#detail_quantity_label').html();

  if(action == 'inc'){
    quantity++;
  }else if(action == 'dec' && quantity > 1){
    quantity--;
  }

  $('#detail_quantity_label').html(quantity);
}

function details_add_to_cart_button(name, price){
  var count = $('#detail_quantity_label').html();
  for(i=0; i<count; i++){
    add_to_cart(name, price);
  }
}

function toggle_review_form(){
  const isVisible = $('#review_form').css('display') == 'block';

  if(isVisible){
    $('#review_form').animate({right: '-1000'}, 'fast', function() {
      $('#review_form').css('display', 'none');
    });

    $('#toggle_review_form_button').val('Add Your Review');
    $('#toggle_review_form_button').css('color', '#A80E0E');
    $('#toggle_review_form_button').css('background', '#FFAA00');
  }else{
    $('#review_form').css('display', 'block');
    $('#review_form').animate({right: '0'}, 'fast');
    $('#toggle_review_form_button').val('Cancel');
    $('#toggle_review_form_button').css('color', '#FFAA00');
    $('#toggle_review_form_button').css('background', '#A80E0E');
  }
}

function count_review_characters(){
  var length = $('#review_textarea').val().length;
  if(length > 0){
    $('#review_textarea_error_message').css('display', 'none');
  }
  $('#textarea_characters_counter').text(`${length} / 500`);
}

function submit_review(meal_id){
  if(document.forms['review_form']['review_textarea'].value.length == 0){
    $('#review_textarea_error_message').css('display', 'block');
    return false;
  }

  if(document.forms['review_form']['review_name'].value.length == 0){
    document.forms['review_form']['review_name'].value = 'Customer';
  }

  var formData = new FormData();
  formData.append('meal_id', meal_id);
  formData.append('review_name', $('#review_name').val());
  formData.append('review', $('#review_textarea').val());
  formData.append('review_rate', $('#review_rate').val());
  formData.append('review_image', $('#review_image')[0].files[0] );
  $.ajax({
    url: "php/review.php",
    method: "POST",
    data: formData,
    processData: false,
    contentType: false
  })
    .done(function(result) {
      showReviews(meal_id);
      toggle_review_form();
    }).fail(function(err) {
      alert("Error occured");
    });
}


function showReviews(meal_id){
  $.ajax({
    url: "php/review.php",
    method: "GET",
    data: { meal_id },
    dataType: "json"
  })
    .done(function(result) {
      var reviews = "";
      if(result.length == 0){
        reviews = "No Reviews";
      }else{
        for(var i=0; i<result.length; i++){
          reviews += `<div class="carousel-item ${i == 0 ? "active" : ""}">
            <div class="row">
              <img class="image_with_shadow col-12 col-lg-6" src="${result[i]['image']}" alt="${result[i]['image']}" height="25%"
              width="25%"/>
              <div class="col-12 col-lg-6 align-self-center">
                <h4>${result[i]['reviewer_name']}</h4>
                <h5>${result[i]['city']} - ${result[i]['date']} ${"&#11088".repeat(result[i]['rating'])}</h5>
                <p>${result[i]['review']}</p>
              </div>
            </div>
          </div>`;
        }
      }
      $('#reviews').html(reviews);
    }).fail(function() {
      $('#reviews').html("Error occured when retrieving reviews");
    });
}
