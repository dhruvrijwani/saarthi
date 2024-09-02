<?php
// Retrieve form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];
$service = $_POST['service'];
$reason = $_POST['reason'];

// Include the database connection file
include 'connection.php';

// Prepare SQL statement to insert data into a table
$sql = "INSERT INTO appointments (first_name, last_name, email, phone, gender, appointment_date, appointment_time, service, reason) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $connection->prepare($sql);

// Check if the prepare statement was successful
if ($stmt === false) {
    die('Error: Unable to prepare statement');
}

// Bind parameters to the prepared statement
$success = $stmt->bind_param("sssssssss", $first_name, $last_name, $email, $phone, $gender, $appointment_date, $appointment_time, $service, $reason);

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
?>
