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
        echo "<script>alert('Recipe added successfully!'); window.location.href='./home.php';</script>";
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
  <link href="statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="statics/js/bootstrap.js"></script>

  <style>
    body {
      background-color: #FAEBD7; /* Light cream background */
    }

    .form-container {
      background: #FFF8DC; /* Lighter cream for contrast */
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #C70039; /* Bold red title */
      font-weight: bold;
      text-align: center;
    }

    .btn-back {
      background-color: #6C757D; /* Dark gray for Back button */
      color: white;
      width: 100%;
      font-weight: bold;
      border-radius: 10px;
    }

    .btn-back:hover {
      background-color: #5a6268;
    }

    .btn-submit {
      background-color: #C70039; /* Red for Add Recipe button */
      color: white;
      font-weight: bold;
      width: 100%;
      border-radius: 10px;
    }

    .btn-submit:hover {
      background-color: #a6002d;
    }

    .form-label {
      font-weight: bold;
      color: #FF8C00; /* Orange labels */
    }

    .form-control {
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    /* Make text areas have a yellow-green outline */
    textarea:focus {
      border-color: #9ACD32 !important; /* Yellow-green outline */
      box-shadow: 0 0 5px #9ACD32 !important;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="form-container">
          <h2>Add New Recipe</h2>

          <a href="home.php" class="btn btn-back mb-3">Back to Recipes</a>

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
              <textarea class="form-control" name="ingredients" rows="3" required></textarea>
            </div>

            <div class="mb-3">
              <label for="instructions" class="form-label">Instructions</label>
              <textarea class="form-control" name="instructions" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-submit">Add Recipe</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
