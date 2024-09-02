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
<html>
  <head>
    <title>Image Upload</title>
    <link rel="stylesheet" href="uploadimage.css" />
  </head>
  <body>
    <?php if (isset($_GET['error'])): ?>
    <p><?php echo $_GET['error']; ?></p>
    <?php endif; ?>

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

    <div class="uiform">
    <form class="form" action="upload.php" method="post" enctype="multipart/form-data">
    <span class="form-title">Upload your file</span>
    <p class="form-paragraph">File should be an image</p>
    <label for="file-input" class="drop-container">
        <span class="drop-title">Drop files here</span>
        or
        <input type="file" name="my_image" id="file-input"/>
        <input type="text" name="image_title" placeholder="Enter image title">
        <input type="submit" name="submit" value="Upload" id="file-input" />
    </label>
</form>

</div>

<?php
require("connection.php");

// Fetch all image titles from the database
$sql = "SELECT image_url, image_title FROM images";
$result = $connection->query($sql);

// Check if the query execution was successful
if ($result === false) {
    // Query execution failed, display the error message
    echo "Error: " . mysqli_error($connection);
} else {
    // Check if there are any records returned
    if ($result->num_rows > 0) {
        echo "<table>";
            echo "<thead>";
            echo "<tr><th>Image Title</th><th>Action</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['image_title'] . "</td>";
                echo "<td>";
                // Create a form with a delete button for each image
                echo "<form method='POST'>";
                echo "<input type='hidden' name='image_url' value='" . $row['image_url'] . "'>";
                echo "<button type='submit' name='delete'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            
            echo "</tbody>";
            echo "</table>";
    } else {
        echo "0 results";
    }
}

// Handle delete action
if(isset($_POST['delete'])) {
  // Get the image URL from $_POST['image_url']
  $imageUrl = $_POST['image_url'];

  // Construct the SQL query to delete the image record
  $deleteQuery = "DELETE FROM images WHERE image_url = '$imageUrl'";

  // Execute the delete query
  if ($connection->query($deleteQuery) === TRUE) {
      // Image deleted successfully
      echo "<script>alert('Image deleted successfully');</script>";
      // Refresh the page to reflect changes
      echo "<script>window.location.href = 'uploadimage.php';</script>";
      exit();
  } else {
      // Error occurred while deleting the image
      echo "<script>alert('Error: Image could not be deleted');</script>";
  }
}


// Close the connection
$connection->close();
?>


  </body>
</html>



