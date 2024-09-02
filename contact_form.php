<?php
// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Include the database connection file
include 'connection.php';

// Prepare SQL statement to insert data into a table
$sql = "INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)"; 
$stmt = $connection->prepare($sql);

// Check if the prepare statement was successful
if ($stmt === false) {
    die('Error: Unable to prepare statement');
}

// Bind parameters to the prepared statement
$success = $stmt->bind_param("ssss", $name, $email, $phone, $message);

// Check if binding parameters was successful
if ($success === false) {
    die('Error: Unable to bind parameters');
}

// Execute the prepared statement
$success = $stmt->execute();

// Check if execution was successful
if ($success === false) {
    die('Error: Unable to execute statement');
}

// If execution was successful
echo 'Appointment submitted successfully';

// Close the statement
$stmt->close();

// Close connection
$connection->close();

// Redirect to index.html
header("Location: contact.html");
exit;

?>