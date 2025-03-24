<?php
// Include database connection
include './database/database.php';

// Check if ID is set and valid
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $error_message = "Invalid request! ID is required.";
} else {
    $id = $_GET['id'];

    // Fetch the recipe securely using a prepared statement
    $stmt = $conn->prepare("SELECT * FROM recipes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        $error_message = "Recipe not found!";
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($row)) {
    // Validate input fields
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $ingredients = trim($_POST['ingredients']);
    $instructions = trim($_POST['instructions']);

    if (empty($title) || empty($description) || empty($ingredients) || empty($instructions)) {
        $error_message = "All fields are required!";
    } else {
        // Prepare update query
        $stmt = $conn->prepare("UPDATE recipes SET title = ?, description = ?, ingredients = ?, instructions = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $title, $description, $ingredients, $instructions, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Recipe updated successfully!'); window.location.href='home.php';</script>";
            exit;
        } else {
            $error_message = "Error updating recipe: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Recipe</title>
  <link href="statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="statics/js/bootstrap.js"></script>

  <style>
    body {
      background-color: #FAF3E0; /* Light beige */
    }

    .container {
      max-width: 500px;
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      margin-top: 50px;
    }

    h2 {
      color: #C70039;
      text-align: center;
      font-weight: bold;
    }

    .btn-back {
      background-color: #6c757d;
      color: white;
      width: 100%;
      font-weight: bold;
    }

    .btn-back:hover {
      background-color: #5a6268;
    }

    label {
      font-weight: bold;
      color: #FF8C00; /* Orange */
    }

    input, textarea {
      border: 2px solid #9ACD32; /* Yellow-green */
      border-radius: 5px;
    }

    textarea {
      resize: none;
    }

    .btn-submit {
      background-color: #C70039;
      color: white;
      width: 100%;
      font-size: 18px;
      font-weight: bold;
      padding: 10px;
      border-radius: 6px;
    }

    .btn-submit:hover {
      background-color: #A0002F;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Update Recipe</h2>

    <!-- Display errors -->
    <?php if (!empty($error_message)): ?>
      <div class="alert alert-danger text-center"><?= htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <?php if (isset($row)): ?>
    <form action="update.php?id=<?= htmlspecialchars($row['id']); ?>" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Recipe Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($row['title']); ?>" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($row['description']); ?></textarea>
      </div>

      <div class="mb-3">
        <label for="ingredients" class="form-label">Ingredients</label>
        <textarea class="form-control" id="ingredients" name="ingredients" rows="3" required><?= htmlspecialchars($row['ingredients']); ?></textarea>
      </div>

      <div class="mb-3">
        <label for="instructions" class="form-label">Instructions</label>
        <textarea class="form-control" id="instructions" name="instructions" rows="3" required><?= htmlspecialchars($row['instructions']); ?></textarea>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-submit">Update Recipe</button>
      </div>
    </form>

    <!-- Back to Recipes Button -->
    <div class="text-center mt-4">
      <a href="home.php" class="btn btn-back">Back to Recipes</a>
    </div>
    <?php endif; ?>
  </div>
</body>
</html>
