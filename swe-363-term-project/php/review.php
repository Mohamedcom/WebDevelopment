<?php
include 'meal_db.php';

$meal_db = new Meal_db;

if($_GET && $_GET["meal_id"]){
  echo $meal_db->getMealReviews($_GET["meal_id"]);
}else if($_POST["meal_id"]){
  $target_dir = "reviewImages/";
  $target_file = $target_dir.time().basename($_FILES['review_image']['name']);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo 'error';
    return;
  }
  $check = getimagesize($_FILES["review_image"]["tmp_name"]);
  if(!$check){
    echo 'error';
    return;
  }
  if(move_uploaded_file($_FILES["review_image"]["tmp_name"], "/Applications/MAMP/htdocs/".$target_file)){
    echo $meal_db->addMealReview($_POST["meal_id"], $_POST["review_name"], $_POST["review"], $_POST["review_rate"], $target_file);
    return;
  }else{
    echo 'error';
    return;
  }
}
?>
