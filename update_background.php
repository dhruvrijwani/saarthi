<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if a file was uploaded
if(isset($_FILES['background_image']) && $_FILES['background_image']['error'] === UPLOAD_ERR_OK) {
    // Specify the directory where you want to store the uploaded image
    $targetDir = "background_images/";
    
    // Move the uploaded file to the specified directory
    $targetFile = $targetDir . basename($_FILES["background_image"]["name"]);
    if(move_uploaded_file($_FILES["background_image"]["tmp_name"], $targetFile)) {
        // Redirect back to the dashboard or show a success message
        header("Location: dashboard.php?success=1");
        exit();
    } else {
        // Handle errors if move_uploaded_file failed
        echo "Error moving uploaded file.";
    }
} else {
    // Handle errors if any
    echo "Error uploading file.";
}
?>
