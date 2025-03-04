<?php

include 'dbconn.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Japan Unveiled Profile</title>

    <link rel="stylesheet" href="dya_userStyle.css">

</head>
<body>
   
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="images/'.$fetch['image'].'">';
         }
      ?>
      <h1><?php echo $fetch['name']; ?></h1>
      <a href="updateprofile.php" class="btn">Update profile</a>
      <a href="homepage.php" class="back-btn">Back to home</a>
      <p>Back to<a href="login.php">Login</a> or <a href="register.php">Register</a></p>
   </div>

</div>

</body>
</html>