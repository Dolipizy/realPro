<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: Log.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];

    // Insert the new property into the database
    $stmt = $pdo->prepare("INSERT INTO properties (user_id, name, type, price) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $name, $type, $price]);

    header("Location: listings.php"); // Redirect to listings page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Add New Property</h1>
        <nav>
            <ul>
                <li><a href="restate.html">Home</a></li>
                <li><a href="listings.php">My Properties</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <form action="add_property.php" method="POST">
            <label for="name">Property Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="type">Property Type:</label>
            <input type="text" id="type" name="type" required>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>

            <button type="submit">Add Property</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2023 Real Estate Portal. All rights reserved.</p>
    </footer>
</body>
</html>