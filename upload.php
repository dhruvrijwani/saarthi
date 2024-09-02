<?php
 require("connection.php");

?>
<!-- this is the php file for uploading images -->


<?php 
require("connection.php");

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include "connection.php";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];

	if ($error === 0) {
		if ($img_size > 10000000) {
			$em = "Sorry, your file is too large.";
		    header("Location: uploadimage.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

                // Retrieve image title from form input
				$imageTitle = mysqli_real_escape_string($connection, $_POST['image_title']);

				// Insert into Database
				$sql = "INSERT INTO images (image_url, image_title) 
				        VALUES ('$new_img_name', '$imageTitle')";
				mysqli_query($connection, $sql);
				header("Location: uploadimage.php");
			}else {
				$em = "You can't upload files of this type";
		        header("Location: uploadimage.php?error=$em");
			}
		}
	}else {
		$em = "Unknown error occurred!";
		header("Location: uploadimage.php?error=$em");
	}

}else {
	header("Location: uploadimage.php");
}
?>
