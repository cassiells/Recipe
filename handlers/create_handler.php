<?php

include "../database/db.php";

try {

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];

    
    $stmt = $conn->prepare("INSERT INTO recipes (title, description, ingredients, instructions) VALUES (?, ?, ?, ?)");

    
    $stmt->bind_param("ssss", $title, $description, $ingredients, $instructions);


    if ($stmt->execute()) {
      header("Location: ../index.php");
      exit;
    } else {
      echo "Operation failed: " . $stmt->error;
    }
  }

} catch (\Exception $e) {
  echo "Error: " . $e->getMessage();
}
