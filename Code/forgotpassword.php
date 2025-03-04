<?php

include 'dbconn.php';

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_password']));
   $cnew_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_new_password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      if($new_pass != $cnew_pass){
         $message[] = 'Confirm password does not match!';
      }else{
   
         $update = mysqli_query($conn, "UPDATE `user_form` SET password = '$new_pass' WHERE email = '$email'") or die('query failed');
         
         if($update){
            $message[] = 'Password changed successfully!';
            header('location:login.php');
         }else{
            $message[] = 'Failed to change the password!';
         }
      }
   }else{
      $message[] = 'No account found with this email!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Forgot Password</title>

   <link rel="stylesheet" href="dya_style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h1>Reset Password</h1>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="Enter email" class="box" required>
      <input type="password" name="new_password" placeholder="Enter new password" class="box" required>
      <input type="password" name="confirm_new_password" placeholder="Confirm new password" class="box" required>
      <input type="submit" name="submit" value="Reset Password" class="btn">
      <p>Remember your password? <a href="login.php">Login now</a></p>
   </form>

</div>

</body>
</html>