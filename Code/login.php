<?php

include 'dbconn.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['user_logged_in'] = true;
      header('location:homepage.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Japan Unveiled Login</title>

   <link rel="stylesheet" href="dya_style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h1>Login now</h1>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="Enter email" class="box" required>
      <input type="password" name="password" placeholder="Enter password" class="box" required>
      <input type="submit" name="submit" value="Login" class="btn">
      <p>Don't have an account? <a href="register.php">Register now</a></p>
      <p>Forgot password? <a href="forgotpassword.php">Reset password</a></p>
   </form>

</div>

</body>
</html>