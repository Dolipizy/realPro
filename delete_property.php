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

// Delete the property from the database
$stmt = $pdo->prepare("DELETE FROM properties WHERE id = ? AND user_id = ?");
$stmt->execute([$property_id, $_SESSION['user_id']]);

header("Location: listings.php"); // Redirect to listings page
exit();
?>