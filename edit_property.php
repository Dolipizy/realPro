<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: Log.html");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: listings.php");
    exit();
}

$property_id = $_GET['id'];

// Fetch the property details
$stmt = $pdo->prepare("SELECT * FROM properties WHERE id = ? AND user_id = ?");
$stmt->execute([$property_id, $_SESSION['user_id']]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    header("Location: listings.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];

    // Update the property in the database
    $stmt = $pdo->prepare("UPDATE properties SET name = ?, type = ?, price = ? WHERE id = ?");
    $stmt->execute([$name, $type, $price, $property_id]);

    header("Location: listings.php"); // Redirect to listings page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Edit Property</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="listings.php">My Properties</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <form action="edit_property.php?id=<?php echo $property_id; ?>" method="POST">
            <label for="name">Property Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($property['name']); ?>" required>

            <label for="type">Property Type:</label>
            <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($property['type']); ?>" required>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($property['price']); ?>" required>

            <button type="submit">Update Property</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2023 Real Estate Portal. All rights reserved.</p>
    </footer>
</body>
</html>