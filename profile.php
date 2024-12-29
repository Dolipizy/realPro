<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: Log.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel='stylesheet' href='bootstrap.min.css'>
    <script src='popper.min.js'></script>
    <script src='bootstrap.min.js'></script>
    <script src='jquery-3.5.1.min.js'></script>
    <link rel="shortcut icon" href="img/building.png" type="image/x-icon">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f0edf43c;
            padding: 1% 3%;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        h1 {
            text-align: justify;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            margin-right: 200px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-top: 1.2rem;
            padding: 0 10px;
            text-decoration: none;
        }

        nav ul li a {
            color: rgb(25, 24, 24);
            position: relative;
        }

        nav ul li a:hover {
            color: #008844;
        }

        main {
            max-width: 1000px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-left: 270px;
            margin-top: 120px;
        }

        .pasion input[type="text"],
        .pasion input[type="email"] {
            width: 500px;
            padding: 5px;
            border: 1px solid black;
            border-radius: 4px;
            margin-left: 230px;
            margin-top: 20px;
        }

        .pasion button[type="submit"] {
            width: 200px;
            padding: 5px;
            border: 1px solid black;
            border-radius: 4px;
            margin-left: 400px;
            margin-top: 20px;
            background-color: #434546;
            color: white;
            cursor: pointer;
        }

        .pasion button[type="submit"]:hover {
            background-color: #008844;
        }

        @media (max-width: 768px) {
            nav ul {
                flex-direction: column;
                align-items: center;
            }

            main {
                padding: 10px;
                margin-left: 0;
            }

            .pasion input[type="text"],
            .pasion input[type="email"] {
                width: 100%;
                margin-left: 0;
            }

            .pasion button[type="submit"] {
                width: 100%;
                margin-left: 0;
            }
        }

        img {
            max-width: 100%;
            height: auto;
        }

        footer {
            text-align: center;
            padding: 3px;
            background-color: #f1f1f1;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 328px;
        }
    </style>
</head>
<body style="background-image: url(img/pexels-foteros-783745.jpg); background-size: cover;">
    <header>
        <h1>User Profile</h1>
        <nav>
            <ul>
                <li><a href="restate.html">Home</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?></h2>
        <div class="pasion">
            <form action="update_profile.php" method="POST">
                <input type="text" id="username" name="username" placeholder="Enter your new username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                <input type="email" id="email" name="email" placeholder="Enter new email address" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                <button type="submit">Update Profile</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2023 Real Estate Portal. All rights reserved.</p>
    </footer>
</body>
</html>
