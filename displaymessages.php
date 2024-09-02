<?php
session_start();
require("connection.php");

if(!isset($_SESSION['AdminLoginId'])) {
    header("location: admin_login.php");
    exit(); // Stop further execution
}

if(isset($_POST['logout'])) {
    session_destroy();
    header("location: admin_login.php");
    exit(); // Stop further execution
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="displaymessages.css">
</head>
<body>
<div class="header">
        <div class="logo">
            <a href="./admin panel.php"> <h3>Saarthi Tarot Dashboard</h3> </a>
        </div>
        <nav class="navbar">
            <a href="./uploadimage.php">Images</a>
            <a href="./appointmentbackend.php">Appointments</a>
            <a href="./displaymessages.php">Messages</a>
        </nav>
        <form method="POST">
            <button class="btn" name="logout">Logout</button>
        </form>
    </div>

<?php
// Include the database connection file
include 'connection.php';

// Query to fetch contact form details
$sql = "SELECT name, email, phone, message FROM contacts";
$result = $connection->query($sql);

// Check if there are any records returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="main">';
        echo '<div class="messages">';
        echo '<h1>Name: ' . $row['name'] . '</h1>';
        echo '<h3>Email: ' . $row['email'] . '</h3>';
        echo '<h3>Phone: ' . $row['phone'] . '</h3>';
        echo '<p>Message: ' . $row['message'] . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No messages found.';
}

// Close connection
$connection->close();
?>
</body>
</html>