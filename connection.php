<?php
// Database details
$servername = "db5015479470.hosting-data.io";
$username = "dbu2232769";
$password = "your_password"; // Update with the provided password
$dbname = "dbs12648310";


// // Connect to your database
// $servername = "localhost";
// $username = "root";
// $password = "123456";
// $dbname = "tarot";

// Connect to the new database
$connection = mysqli_connect("db5015479470.hosting-data.io","dbu2232769","your_password","dbs12648310");

if (mysqli_connect_error()) {
    echo "Cannot Connect: " . mysqli_connect_error();
}
?>
