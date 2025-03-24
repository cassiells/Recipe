<?php
session_start();
include './database/database.php';
include './helpers/not_authenticated.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recipe System</title>
  <link href="statics/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script src="statics/js/bootstrap.bundle.min.js"></script>
  
  <style>
    /* Background color - Warm and neutral */
    body {
      background-color: #FAF3E0; /* Soft off-white */
      color: #333333; /* Dark gray for readable text */
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    /* Recipe Card */
    .card {
      width: 500px;
      padding: 40px;
      border-radius: 12px;
      background: #FFF7E6; /* Warm beige */
      color: #6F4E37; /* Deep brown text */
      box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
    }

    /* Form Labels - Orange for warmth */
    .form-label {
      font-size: 1.2rem;
      font-weight: bold;
      color: #FF8C42; /* Orange */
      margin-bottom: 8px;
    }

    /* Form Fields */
    .form-control {
      font-size: 1rem;
      padding: 10px;
      height: 40px;
      border-radius: 8px;
      border: 1px solid #A7C957; /* Soft green border */
    }

    .mb-3 {
      margin-bottom: 15px;
    }

    /* Custom Button - Appetizing Red */
    .btn-custom {
      background: #D72638; /* Red */
      border: none;
      color: white;
      font-size: 1.2rem;
      font-weight: bold;
      padding: 12px;
      border-radius: 8px;
      transition: 0.3s;
      margin-top: 15px;
    }

    .btn-custom:hover {
      background: #A71D31; /* Darker red on hover */
    }

    /* Alert Message */
    .alert {
      font-size: 1rem;
      background: #FFD700; /* Bright yellow */
      color: #333333;
      font-weight: bold;
      border-radius: 8px;
    }

    /* Highlighted Links */
    .text-highlight {
      color: #4CAF50; /* Fresh green */
      font-weight: bold;
      font-size: 1.1rem;
    }

    /* Recipe System Title */
    .login-title {
      font-size: 3rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
      color: #D72638; /* Red for energy */
    }

    /* Spacer */
    .spacer {
      margin-bottom: 20px;
    }

    /* Footer Text */
    .text-center small {
      color: #666;
      font-size: 0.9rem;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="col-md-6 mx-auto">
      <div class="text-center mb-4">
        <h1 class="login-title">🍽️ Recipe System 🍲</h1>
        <p class="text-dark">Login to continue</p>
      </div>
      <div class="card">
        <?php if (isset($_SESSION['errors'])): ?>
          <div class="alert alert-danger text-center spacer">
            <?php echo $_SESSION['errors']; unset($_SESSION['errors']); ?>
          </div>
        <?php endif; ?>

        <form action="handlers/login_handler.php" method="POST">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required />
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-custom">
              Login&nbsp;&nbsp;<i class="fa-solid fa-right-to-bracket"></i>
            </button>
          </div>
        </form>

        <div class="text-center mt-4">
          <small>Don't have an account? <a href="register.php" class="text-highlight text-decoration-none">Sign Up</a></small>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
