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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <script src="statics/js/bootstrap.js"></script>

  <style>
    body {
      background-color: #FAEBD7; /* Light cream background */
    }

    .container {
      max-width: 800px;
    }

    .recipe-card {
      background: #FFF8DC; /* Soft cream background */
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out;
    }

    .recipe-card:hover {
      transform: scale(1.02);
    }

    .recipe-title {
  font-size: 52px; /* Bigger font */
  font-weight: 800; /* Extra bold */
  color: #C70039; /* Red */
  letter-spacing: 3px; /* Wider spacing */
  text-transform: uppercase;
}
.recipe-title {
      font-size: 32px;
      font-weight: bold;
      color: #C70039; /* Red title */
    }

    .recipe-description {
      font-size: 16px;
      color: #555;
    }

    .btn-add {
      background-color: #C70039; /* Red */
      color: white;
      border-radius: 10px;
      font-weight: bold;
    }

    .btn-add:hover {
      background-color: #a6002d;
    }

    .btn-edit {
      background-color: #17A2B8; /* Blue */
      color: white;
      border-radius: 10px;
    }

    .btn-edit:hover {
      background-color: #138496;
    }

    .btn-delete {
      background-color: #FF8C00; /* Orange */
      color: white;
      border-radius: 10px;
    }

    .btn-delete:hover {
      background-color: #e07b00;
    }

    .no-recipes {
      text-align: center;
      background-color: rgb(132, 67, 161);
      font-size: 20px;
      color: white;
      padding: 15px;
      border-radius: 10px;
    }
    .logout-link {
  color: #C70039; /* Deep red to match theme */
  text-decoration: none; /* No underline */
  font-size: 18px; /* Make it readable */
  font-weight: bold;
}

.logout-link i {
  margin-left: 5px; /* Space between text and icon */
}

.logout-link:hover {
  text-decoration: underline; /* Underline on hover */
  color: #A0002F; /* Darker red for hover effect */
}

.delete-btn {
  background-color: #FF8C00 !important; /* Orange to match label color */
  color: white !important; /* White text for readability */
  border: none;
  border-radius: 5px; /* Rounded corners for a softer look */
  padding: 8px 12px;
}

.delete-btn:hover {
  background-color: #E67300 !important; /* Slightly darker orange on hover */
}

  </style>
</head>
<body>
  <div class="container my-5">
  <div class="text-center mb-4">
  <h1 class="recipe-title"> 📙  RECIPE BOOK 🍓 </h1>
  <p class="lead text-muted">Discover and share amazing recipes with others!</p>
</div>


    <div class="mb-4 text-center">
      <a href="create.php" class="btn btn-lg btn-add">Add New Recipe</a>
    </div>

    <?php
      $res = $conn->query("SELECT * FROM recipes");
    ?>

    <?php if($res->num_rows > 0): ?>
        <?php while($row = $res->fetch_assoc()): ?>
        <div class="recipe-card my-3">
            <h5 class="recipe-title"><?= $row['title']; ?></h5>
            <p class="recipe-description"><?= $row['description']; ?></p>
            <p><strong style="color: #FF8C00;">Ingredients:</strong> <?= $row['ingredients']; ?></p>
            <p><strong style="color: #FF8C00;">Instructions:</strong> <?= $row['instructions']; ?></p>
            
            <div class="d-flex justify-content-between">
                <a href="update.php?id=<?=$row['id'];?>" class="btn btn-sm btn-edit">Edit</a>
                <a href="handlers/delete_handler.php?id=<?=$row['id'];?>" class="btn btn-sm btn-delete">Delete</a>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="no-recipes">
            🎉 No recipes yet! Time to add some tasty dishes!
        </div>
    <?php endif; ?>
  </div>
  <div class="text-center mt-4">
  <a href="./handlers/logout_handler.php" class="logout-link">
    Logout <i class="fa-solid fa-right-from-bracket"></i>
  </a>
</div>
</body>
</html>
