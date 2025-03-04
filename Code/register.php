<?php

include 'dbconn.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'images/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'Already have an account with this email'; 
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'Image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password, image) VALUES('$name', '$email', '$pass', '$image')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Registered successfully!';
            header('location:login.php');
         }else{
            $message[] = 'Registration failed!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Japan Unveiled Register</title>

   <link rel="stylesheet" href="dya_style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h1>Register now</h1>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="name" placeholder="Enter username" class="box" required>
      <input type="email" name="email" placeholder="Enter email" class="box" required>
      <input type="password" name="password" placeholder="Enter password" class="box" required>
      <input type="password" name="cpassword" placeholder="Confirm password" class="box" required>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="Register now" class="btn">
      <p>Already have an account? <a href="login.php">Login now</a></p>
   </form>

</div>

</body>
</html>