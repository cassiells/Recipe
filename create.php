<?php
include './database/database.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];

    $stmt = $conn->prepare("INSERT INTO recipes (title, description, ingredients, instructions) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $ingredients, $instructions);

    if ($stmt->execute()) {
        echo "<script>alert('Recipe added successfully!'); window.location.href='./index.php';</script>";
    } else {
        echo "Error adding recipe: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Recipe</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="../statics/js/bootstrap.js"></script>
</head>
<body>
  <div class="container mt-5">
    <h2>Add New Recipe</h2>

    <a href="index.php" class="btn btn-secondary mb-3">Back to Recipes</a>

    <form action="create.php" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Recipe Name</label>
        <input type="text" name="title" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Recipe Description</label>
        <input type="text" name="description" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="ingredients" class="form-label">Ingredients</label>
        <textarea class="form-control" name="ingredients" rows="4" required></textarea>
      </div>

      <div class="mb-3">
        <label for="instructions" class="form-label">Instructions</label>
        <textarea class="form-control" name="instructions" rows="4" required></textarea>
      </div>

      <button type="submit" class="btn btn-success">Add Recipe</button>
    </form>
  </div>
</body>
</html>
