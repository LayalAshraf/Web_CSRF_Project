<?php
    // Create Connection
    $conn = mysqli_connect('localhost', 'root', '1234', 'Music_House'); //add your name in username 

    // Check Connection
    if(mysqli_connect_errno()){
        // Connection Failed
        die("Failed to connect to MySQL");
    }
    
if(isset($_POST['login_user'])){

   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $password = md5($_POST['password']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM customer WHERE Cusr = '$username' && password = '$password' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result)==1){
      session_start();
      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['CID'] = $row['CID'];
         header('location:Admin.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['CID'] = $row['CID'];
         header('location:User-Profile.php');

      }
     
   }else{
      $error[] = 'Incorrect username or password!';
   }

};

?>
