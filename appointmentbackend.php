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
    <title>Appointments</title> 
    <link rel="stylesheet" href="appointmentbackend.css">
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
    require("connection.php");

    // SQL query to select all records from the appointment table ordered by appointment date descending
    $sql = "SELECT * FROM appointments order by appointment_id desc;";

    // Execute the query
    $result = $connection->query($sql);

    // Check if there are any records returned
    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<table>";
        echo "<tr><th>Appointment ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Gender</th><th>Service</th><th>Appointment Date</th><th>Appointment Time</th><th>Reason</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['appointment_id'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['service'] . "</td>";
            echo "<td>" . $row['appointment_date'] . "</td>";
            echo "<td>" . $row['appointment_time'] . "</td>";
            echo "<td>" . $row['reason'] . "</td>";
            // Adding accept and delete buttons
            echo "<td>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='appointment_id' value='" . $row['appointment_id'] . "'>";
            echo "<button type='submit' class='btn' name='accept'>Accept</button>";
            echo "<button type='submit' class='btn btn-danger' name='reject'>Reject</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Accept action
    if(isset($_POST['accept'])) {
        // Get the appointment ID from $_POST['appointment_id']
        $appointmentId = $_POST['appointment_id'];

        // Update the appointment status in the database
        $updateQuery = "UPDATE appointments SET status = 'Accepted' WHERE appointment_id = $appointmentId";

        // Execute the update query
        if ($connection->query($updateQuery) === TRUE) {
            // Appointment accepted successfully

            // Retrieve the appointment details to get the phone number and other information
            $selectQuery = "SELECT * FROM appointments WHERE appointment_id = $appointmentId";
            $result = $connection->query($selectQuery);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $phone = $row['phone'];
                $appointmentDate = $row['appointment_date'];
                $appointmentTime = $row['appointment_time'];
                $firstName = $row['first_name']; // Retrieve first name from the appointment details

                // Construct the message with the user's first name
                $message = "Hello $firstName, Thank you for your interest in Sarthi Tarot. Your appointment is scheduled for $appointmentDate at $appointmentTime.";

                // URL encode the message for use in the WhatsApp URL
                $encodedMessage = urlencode($message);

                // Construct the WhatsApp URL with the phone number and encoded message
                $whatsappURL = "https://wa.me/$phone/?text=$encodedMessage";

                // Redirect to WhatsApp with the phone number and message
                echo "<script>window.location.href = '$whatsappURL';</script>";
                exit();
            } else {
                echo "<script>alert('Error: Appointment details not found');</script>";
            }
        } else {
            // Error occurred while updating the appointment status
            echo "<script>alert('Error: Appointment could not be accepted');</script>";
        }
    }

     // reject action
     if(isset($_POST['reject'])) {
        // Get the appointment ID from $_POST['appointment_id']
        $appointmentId = $_POST['appointment_id'];

        // Update the appointment status in the database
        $updateQuery = "UPDATE appointments SET status = 'Rejected' WHERE appointment_id = $appointmentId";

        // Execute the update query
        if ($connection->query($updateQuery) === TRUE) {
            // Appointment accepted successfully

            // Retrieve the appointment details to get the phone number and other information
            $selectQuery = "SELECT * FROM appointments WHERE appointment_id = $appointmentId";
            $result = $connection->query($selectQuery);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $phone = $row['phone'];
                $firstName = $row['first_name']; // Retrieve first name from the appointment details

                // Construct the message with the user's first name
                $message = "Hello $firstName, We regret to inform you that we are unable to book your appointment at this time. If you have any further questions, please feel free to contact us. Thank you.";

                // URL encode the message for use in the WhatsApp URL
                $encodedMessage = urlencode($message);

                // Construct the WhatsApp URL with the phone number and encoded message
                $whatsappURL = "https://wa.me/$phone/?text=$encodedMessage";

                // Redirect to WhatsApp with the phone number and message
                echo "<script>window.location.href = '$whatsappURL';</script>";
                exit();
            } else {
                echo "<script>alert('Error: Appointment details not found');</script>";
            }
        } else {
            // Error occurred while updating the appointment status
            echo "<script>alert('Error: Appointment could not be rejected');</script>";
        }
    }


    // // Reject action
    // if(isset($_POST['reject'])) {
    //     // Get the appointment ID from $_POST['appointment_id']
    //     $appointmentId = $_POST['appointment_id'];

    //     // Update the appointment status in the database to "Rejected"
    //     $updateQuery = "UPDATE appointments SET status = 'Rejected' WHERE appointment_id = $appointmentId";

    //     // Execute the update query
    //     if ($connection->query($updateQuery) === TRUE) {
    //         // Appointment rejected successfully
    //         echo "<script>alert('Appointment rejected successfully');</script>";
    //     } else {
    //         // Error occurred while updating the appointment status
    //         echo "<script>alert('Error: Appointment could not be rejected');</script>";
    //     }
    // }


    // Close the connection
    $connection->close();
?>
</body>
</html>
