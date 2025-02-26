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
            echo "<script>alert('Recipe updated successfully!'); window.location.href='./index.php';</script>";
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
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h2 class="text-center mb-4">Update Recipe</h2>

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
            <button type="submit" class="btn btn-success">Update Recipe</button>
          </div>
        </form>

        <!-- Back to Recipes Button -->
        <div class="text-center mt-4">
          <a href="index.php" class="btn btn-secondary">Back to Recipes</a>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>
