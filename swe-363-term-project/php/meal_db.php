<?php
class Meal_db {

  private $conn;

  function __construct() {
    $this->conn = new mysqli("127.0.0.1", "root", "");

    if ($this->conn->connect_error) {
      die("MySQL connection failed");
    }
  }


  private function proccessMealObject($meal){
    $sql = "SELECT AVG(rating) as avgRating FROM meals.reviews WHERE meal_id=".$meal["id"];
    $result = $this->conn->query($sql);

    $meal["rating"] = round($result->fetch_assoc()["avgRating"]) ?? 0;
    $meal["price"] = round($meal["price"], 1);

    return $meal;
  }

  public function getAllMeals() {
    $sql = "SELECT * FROM meals.meals";
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
      $mealsArray = [];
      while($row = $result->fetch_assoc()) {
        array_push($mealsArray, $this->proccessMealObject($row));
      }
      return $mealsArray;
    } else {
      return [];
    }
  }

  public function getMealById($id) {
    $sql = "SELECT * FROM meals.meals WHERE id=".$id;
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
      $meal_result = $this->proccessMealObject($result->fetch_assoc());
      return $meal_result;
    } else {
      return;
    }
  }

  public function getMealReviews($meal_id){
    $sql = "SELECT * FROM meals.reviews WHERE meal_id=".$meal_id;
    $result = $this->conn->query($sql);

    $reviewsArray = [];
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        array_push($reviewsArray, $row);
      }
    }
    return json_encode($reviewsArray);
  }

  public function addMealReview($meal_id, $reviewer_name, $review, $rate, $image){
    $cities = ["Riyadh", "Jeddah", "Dhahran", "Khobar", "Dammam", "Medina"];
    $sql = "INSERT INTO meals.reviews (reviewer_name, review, rating, image, city, date, meal_id) VALUES ('".$reviewer_name."', '".$review."', ".$rate.", '".$image."', '".$cities[array_rand($cities)]."', '".date('Y-m-d H:i:s')."', ".$meal_id.") ";
    $result = $this->conn->query($sql);
    return $review;
  }
}
?>
