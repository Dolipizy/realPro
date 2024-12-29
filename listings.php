<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: Log.html");
    exit();
}

// Fetch properties from the database
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM properties WHERE user_id = ?");
$stmt->execute([$user_id]);
$properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Property Listings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #4CAF50; /* Green background */
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #4CAF50; /* Green color for headings */
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            margin: 10px 0;
            background-color: #4CAF50; /* Green background */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2; /* Light gray background for header */
        }

        tr:hover {
            background-color: #f5f5f5; /* Light gray on row hover */
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: #4CAF50; /* Green background */
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Your Property Listings</h1>
        <nav>
            <ul>
                <li><a href="restate.html">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>My Properties</h2>
        <a href="add_property.php" class="button">Add New Property</a>

        <?php if (count($properties) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Property Name</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($properties as $property): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($property['name']); ?></td>
                            <td><?php echo htmlspecialchars($property['type']); ?></td>
                            <td><?php echo htmlspecialchars($property['price']); ?></td>
                            <td>
                                <a href="edit_property.php?id=<?php echo $property['id']; ?>" class="button">Edit</a>
                                <a href="delete_property.php?id=<?php echo $property['id']; ?>" class="button" onclick="return confirm('Are you sure you want to delete this property?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No properties found. <a href="add_property.php">Add a new property</a>.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2023 Real Estate Portal. All rights reserved.</p>
    </footer>
</body>
</html>