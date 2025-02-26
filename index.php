<?php
include './database/database.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recipe Book</title>
  <link href="statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="statics/js/bootstrap.js"></script>

  <style>
    .recipe-card {
      transition: transform 0.3s ease-in-out;
    }

    .recipe-title {
      font-size: 48px;
      font-weight: bold;
      color: #333;
    }

    .recipe-description {
      font-size: 16px;
      color: #555;
    }

    .no-recipes-text {
      background-color:rgb(132, 67, 161);
      font-size: 20px;
      color: #999;
    }

    .btn-custom {
      background-color: #6c757d;
      color: white;
      border-radius: 50px;
    }

    .btn-custom:hover {
      background-color: #5a6268;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="text-center mb-4">
          <h1 class="display-4 fw-bold text-danger">RECIPE BOOK</h1>
          <p class="lead text-muted">Discover and share amazing recipes with others!</p>
        </div>

        <div class="mb-4 text-center">
          <a href="create.php" class="btn btn-lg btn-danger">Add New Recipe</a>
        </div>

        <?php
          $res = $conn->query("SELECT * FROM recipes");
        ?>

        <?php if($res->num_rows > 0): ?>
            <?php while($row = $res->fetch_assoc()): ?>
            <div class="row border rounded p-3 my-3">
                <div>
                  <h5 class="fw-bold"><?= $row['title']; ?></h5>
                  <p class="text-secondary"><?= $row['description']; ?></p>
                  <p><strong>Ingredients:</strong> <?= $row['ingredients']; ?></p>
                  <p><strong>Instructions:</strong> <?= $row['instructions']; ?></p>
                  
                  <div class="row my-1">
                      <a href="update.php?id=<?=$row['id'];?>" class="btn btn-sm btn-info">Edit</a>
                  </div>
                  <div class="row my-1">
                      <a href="handlers/delete_handler.php?id=<?=$row['id'];?>" class="btn btn-sm btn-warning">Delete</a>
                  </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="row border rounded p-3 my-3 text-center">
                <div class="col mt-3">
                    <p class="text-muted">🎉 No recipes yet! Time to add some tasty dishes!</p>
                </div>
            </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>
