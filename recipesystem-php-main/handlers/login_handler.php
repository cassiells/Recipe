<?php
session_start();
include "../database/database.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); 
    $password = trim($_POST['password']);

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    
    if (!$stmt) {
        die("Database error: " . $conn->error);
    }

    // Bind parameter (s = string)
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['access_token'] = bin2hex(random_bytes(32));
            setcookie("access_token", $_SESSION['access_token'], time() + (86400 * 30), "/");

            header("Location: ../home.php");
            exit;
        } else {
            $_SESSION['errors'] = "Invalid username or password.";
        }
    } else {
        $_SESSION['errors'] = "Username not found.";
    }

    $stmt->close();
    $conn->close();
    header("Location: ../index.php");
    exit;
}
?>

