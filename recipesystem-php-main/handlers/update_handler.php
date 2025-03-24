<?php

include "../database/db.php";

try {

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
   
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];

    
    $stmt = $conn->prepare("UPDATE recipes SET title = ?, description = ?, ingredients = ?, instructions = ? WHERE id = ?");

    $stmt->bind_param("ssssi", $title, $description, $ingredients, $instructions, $id);

    
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
?>
