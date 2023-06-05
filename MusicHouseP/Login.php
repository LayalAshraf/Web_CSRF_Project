<?php
session_start();
    // connect to the database
    include('config/connection.php');

 if ($_POST){
  //Avoid CSRF attack
  if ($_SESSION["token"] != $_POST["token"]) {

    echo '<script type = "text/javascript">';
        echo 'alert ("Invalid token; possibility of CSRF attack!");';
        echo 'window.location.href = "User-Profile.php" ';
        echo '</script>';
        exit();
        die ("");
   }
  }
  
   // generate tokens
   $_SESSION["token"] = md5(uniqid(mt_rand(),true));
	//echo $_SESSION["token"];

    // LOGIN USER 
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $query = "SELECT * FROM customer WHERE Cusr='$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // CHECKING IF USERNAME AND PASS ARE CORRECT
    if (mysqli_num_rows($result) > 0 && password_verify($password, $row['password']))
    {
		$_SESSION['username'] = $row['Cusr'];
		$_SESSION['userLogin'] = "Loggedin";
		header('location: User-Profile.php');
    }else {
      echo '<script type = "text/javascript">';
      echo 'alert ("Wrong Username/Password! Try Again.");';
      echo 'window.location.href = "Login.php" ';
      echo '</script>';
    }


  }
    ?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <title>Login</title>
<?php include "include/header.php" ?>

<style type="text/css">
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }

        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 700px;
            height: 350px;
            background: #ebdad0;
            border-radius: 10%;
        }

        .center h1 {
            text-align: center;
            padding: 0 0 20px 0;
            border-bottom: 1px solid #96742e;
        }

        .center form {
            padding: 0 40px;
            box-sizing: border-box;
        }

        form .txt_field {
            position: relative;
            border-bottom: 2px solid #96742e;
            margin: 30px 0;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .txt_field input {
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            background: none;
            outline: none;
        }



        .txt_field label {
            position: absolute;
            top: 50%;
            left: 5px;
            color: #514543;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
            transition: .5s;
        }

        .txt_field span::before {
            content: '';
            position: absolute;
            top: 40px;
            left: 0;
            width: 0%;
            height: 2px;
            background: #514543;
            transition: .5s;
        }

        .txt_field input:focus~label,
        .txt_field input:valid~label {
            top: -10px;
            color: #514543;
        }

        .txt_field input:focus~span::before,
        .txt_field input:valid~span::before {
            width: 100%;
        }

        .center button {
            width: 100%;
            height: 40px;
            border: 1px solid;
            border-radius: 25px;
            font-size: 18px;
            color: #514543;
            font-weight: 700;
            cursor: pointer;
            outline: none;
        }

        .center button:hover {
            border-color: #514543;
            transition: .5s;
        }

        .img {
            position: absolute;
            /* size: 1px; */
            top: 30px;
            left: 450px;
        }
    </style>
   </head>
<body>

    <section class="center">
        <h1>Login</h1>
        <form method="POST" action="Login.php">
            <div class="txt_field">
                <input type="text" name="username"required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <!-- div class="pass" later -->
                <input type="hidden" name="token" value="<?=$_SESSION["token"]?>">
                <button class="btn" type="submit" name="login_user" value="press">Login</button>  
 
        </form>
    </section>
    <h1 style="color: white;">.</h1>
    <h1 style="color: white;">.</h1>
    <h1 style="color: white;">.</h1>
    <h1 style="color: white;">.</h1>
    <h3 style="color: white;">.</h3>
    
    <?php include "include/footer.php" ?>

</body>
</html>
