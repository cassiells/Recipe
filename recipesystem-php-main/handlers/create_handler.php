<?php
include '../database/database.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $ingredients = $_POST['ingredients'];
  $instructions = $_POST['instructions'];
  
    if (empty($title) || empty($description) || empty($ingredients) || empty($instructions)) {
      echo("Error: All fields are required.");
  }

    $sql = "INSERT INTO recipe (title, description, ingredients, instructions) VALUES (?, ?,?, ?)";
    $stmt = $conn->prepare($sql);

if ($stmt) {   
       $stmt->bind_param("ssss", $title, $description, $ingredients,$instructions);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../index.php");
        exit;
    } else {
        echo ("operation failed" .$stmt->error);
    }

   } else {
        echo ("Error: " .$conn->error);
   }
}

?>