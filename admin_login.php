<?php
require("connection.php");

if(isset($_POST['signIn'])) {
    $adminName = mysqli_real_escape_string($connection, $_POST['AdminName']);
    $adminPassword = mysqli_real_escape_string($connection, $_POST['AdminPassword']);

    $query = "SELECT * FROM tarot.admin WHERE username='$adminName' AND password='$adminPassword'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['AdminLoginId'] = $adminName;
        header("location: admin panel.php");
        exit();
    } else {
        echo "<script>alert('Incorrect username or password');</script>";
    }
}
?>

<html>
<head>
<title>Login</title>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<link rel="stylesheet" type="text/css" href="admin_login.css">
</head>
<body>

<div class="login-form">  
    <div class="container">
    <div class="heading">Sign In</div>
    <form method="POST" class="form">
      <input class="input" name="AdminName"  placeholder="Username">
      <input class="input" type="password" name="AdminPassword"  placeholder="Password">
      <input class="login-button" type="submit" name="signIn" value="Sign In">
    </form>
  </div>
</div>

</body>
</html> 
