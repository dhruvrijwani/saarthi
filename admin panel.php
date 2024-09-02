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

if (isset($_POST['change_username'])) {
    // Retrieve new username from form
    $newUsername = $_POST['new_username'];

    // Validate and sanitize the new username (e.g., check for length, special characters, etc.)

    // Prepare the update query (use placeholders for security)
    $updateQuery = "UPDATE admin SET username = ? WHERE id = 1";

    try {
        // Prepare the statement
        $stmt = $connection->prepare($updateQuery);
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $connection->error);
        }

        // Bind parameters
        $stmt->bind_param("s", $newUsername);

        // Execute the update query
        if ($stmt->execute()) {
            echo "<script>alert('Username updated successfully');</script>";
        } else {
            throw new Exception("Error updating username: " . $stmt->error);
        }

        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}

if(isset($_POST['change_password'])) {
    // Retrieve new password from form
    $newPassword = $_POST['new_password'];

    // Update the current user's password in the database
    $updateQuery = "UPDATE admin SET password = '$newPassword' WHERE id = {$_SESSION['AdminLoginId']}";

    // Execute the update query
    if ($connection->query($updateQuery) === TRUE) {
        echo "<script>alert('Password updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating password');</script>";
    }
}

// Fetch all admin users
$sql = "SELECT * FROM admin";
$result = $connection->query($sql);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin_panel.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h3 {
            margin: 0;
        }
        .navbar {
            display: flex;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 0 5px;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .main {
            padding: 20px;
            margin: 20px auto;
            background-color: #fff;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .main h2 {
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
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


    <div class="main">
        <h2>Change Username</h2>
        <form method="POST">
            <div class="form-group">
                <label for="new_username">New Username:</label>
                <input type="text" id="new_username" name="new_username" required>
            </div>
            <button type="submit" name="change_username" class="btn">Change Username</button>
        </form>

        <h2>Change Password</h2>
        <form method="POST">
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <button type="submit" name="change_password" class="btn">Change Password</button>
        </form>
    </div>

    <div class="table-container">
        <h2>Manage Admin Users</h2>
        <table>
            <tr>
                <th>Username</th>
                <th>Password</th>
            </tr>
            <?php
            if ($result === FALSE) {
                echo "<tr><td colspan='3'>Error fetching admin users</td></tr>";
            } elseif ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['username']}</td>";
                    echo "<td>{$row['password']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No admin users found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
