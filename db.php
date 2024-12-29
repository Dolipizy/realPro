 

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connection</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            /* backdrop-filter: blur(10px); */
            transition: transform 0.3s;
        }
        .container:hover {
            transform: scale(1.05);
        }
        h1 {
            margin-bottom: 20px;
            font-size: 2.5em;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        .success {
            color: #28a745;
            font-weight: bold;
            font-size: 1.2em;
            margin: 10px 0;
        }
        .error {
            color: #dc3545;
            font-weight: bold;
            font-size: 1.2em;
            margin: 10px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Database Connection Status</h1>
    /
    // Check connection
    if ($conn->connect_error) {
        echo "<p class='error'>Connection failed: " . $conn->connect_error . "</p>";
    } else {
        echo "<p class='success'>Connected successfully to the database: <strong>$dbname</strong></p>";
    }

    // Close the connection (optional, but good practice)
    // $conn->close();
    ?>
    <div class="footer">© 2023 </div>
</div>

</body>
</html>
 -->



 <?php
$host = 'localhost'; // Change if your database is hosted elsewhere
$db = 'real_estate_portal';
$user = 'root'; // Your database username
$pass = ''; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>