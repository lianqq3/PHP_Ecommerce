<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:Login.php');
      }
   }

};


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action ="" method = "post">
        <?php
            if(isset($error))
            {
                foreach($error as $error)
                {
                    echo $error;
                }
            }
        ?>
        <input type = "text" name = "name" required placeholder = "Enter your name">
        <input type = "email" name = "email" required placeholder = "Enter your email">
        <input type = "password" name = "password" required placeholder = "Enter your password">
        <input type = "password" name = "cpassword" required placeholder = "Confirm your password">
        <select name = "user_type">
            <option value = "user">user</option>
            <option value = "admin">adimn</option>
        </select>
        <input type = "submit" name = "submit" value = "register now" class = "form-btn">
        <p>already have an account? <a href = "Login.php"> login now </a></p>
    </form>
</body>
</html>