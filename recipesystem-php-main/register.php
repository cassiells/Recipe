<?php
session_start();
include './helpers/not_authenticated.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recipe System - Sign Up</title>
  <link href="statics/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script src="statics/js/bootstrap.bundle.min.js"></script>
  
  <style>
   /* Background - Warm & inviting */
body {
  background: #FAF3E0; /* Soft beige */
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  font-family: "Poppins", sans-serif; /* Modern & clean font */
}

/* Card Container */
.card {
  width: 550px;
  padding: 25px;
  border-radius: 12px;
  background: #FFF7E6; /* Light cream */
  box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1); /* Softer shadow */
  text-align: center;
  border: 1px solid #FFD9A0; /* Subtle border */
}

/* Title */
.login-title {
  font-size: 2.3rem;
  font-weight: bold;
  color: #D72638; /* Red */
  margin-bottom: 5px;
}

/* Subtext */
.subtext {
  font-size: 1rem;
  color: #666;
  margin-bottom: 20px;
}
/* Form Labels */
.form-label {
  margin-bottom: 10px;
  font-size: 1rem;
  font-weight: bold;
  color: #FF8C42; /* Orange */
  text-align: left;
  display: block;
}
/* Input Fields */
.form-control {
  font-size: 1rem;
  padding: 10px;
  width: 100%;
  border-radius: 6px;
  border: 2px solid #A7C957; /* Green border */
  background: #FFF;
  transition: 0.3s;
}
.form-control:focus {
  border-color: #FF8C42; /* Highlight orange */
  box-shadow: 0 0 5px rgba(255, 140, 66, 0.5);
  outline: none;
}
/* Button */
.btn-custom {
  background: #D72638; /* Appetizing red */
  border: none;
  color: white;
  font-size: 1.2rem;
  font-weight: bold;
  padding: 12px;
  border-radius: 6px;
  transition: 0.3s;
  width: 100%;
}
.btn-custom:hover {
  background: #A71D31; /* Darker red */
}
/* Sign In Link */
.signup-link {
  font-size: 1rem;
  color: #4CAF50; /* Green */
  font-weight: bold;
  text-decoration: none;
}
.signup-link:hover {
  text-decoration: underline;
}
/* Small Text */
.text-center small {
  color: #555;
  font-size: 0.9rem;
}
/* Spacing */
.mb-3 {
  margin-bottom: 15px;
}
.d-grid {
  margin-top: 20px;
}
.text-center.mt-3 {
  margin-top: 15px;
}
  </style>
</head>

<body>
  <div class="container">
    <div class="col-md-6 mx-auto">
      <div class="text-center ">
        <h1 class="login-title">🍽️ Create Account 🎉</h1>
        <p class="subtext">Sign up to continue</p>
      </div>
      <div class="card">
        <?php if (!empty($_SESSION['errors'])): ?>
          <div class="alert alert-danger text-center">
            <?php echo $_SESSION['errors']; unset($_SESSION['errors']); ?>
          </div>
        <?php endif; ?>

        <form action="handlers/register_handler.php" method="POST" novalidate>
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" required />
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-custom">
              Sign Up&nbsp;&nbsp;<i class="fa-solid fa-user-plus"></i>
            </button>
          </div>
        </form>

        <div class="text-center mt-3">
          <small>Already have an account? <a href="index.php" class="signup-link">Sign In</a></small>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
