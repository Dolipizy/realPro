<?php
require 'db.php';

session_start(); // Start the session

if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, show the login form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare and execute the SQL statement
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: restate.html"); // Redirect to home page
            exit();
        } else {
            echo "Invalid username or password.";
        }
    }
} else {
    // If the user is already logged in, redirect to the home page
    header("Location: restate.html");
    exit();
}
?>