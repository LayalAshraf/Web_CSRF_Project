<?php
session_start();
include('config/connection.php');

	
// SIGN UP USER 
if (isset($_POST['signup_user'])) {
    // collect form data
    $username = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
    $passwordRepeat = filter_var(trim($_POST['cpass']), FILTER_SANITIZE_STRING);

    // check if password and confirm password are same
    if($password !== $passwordRepeat) {
        echo '<script type = "text/javascript">';
        echo 'alert ("Passwords do not match! Try Again.");';
        echo 'window.location.href = "Sign-Up.php" ';
        echo '</script>';
        exit();
    }

	// Check if username or email already exists in the customer table
    $query = "SELECT * FROM customer WHERE Cusr = '$username' AND email = '$email'";
    $result = mysqli_query($conn, $query);

	if(mysqli_num_rows($result) > 0) {
        // If a row is found with the username or email, then it is already taken
        echo '<script type = "text/javascript">';
        echo 'alert ("Username or Email is already taken! Try Again.");';
	echo 'window.location.href = "Sign-Up.php" ';
        echo '</script>';
        exit();
    } else {

    // hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
    // Insert into customer table
    $query = "INSERT INTO customer (Cusr, password, email) VALUES ('$username', '$hashedPassword', '$email')";

    if (mysqli_query($conn, $query)) {
    echo "before redirect";
        // redirect to login page
        header('Location: Login.php');
        exit();
    } else {
    echo "in else";
        echo '<script type = "text/javascript">';
        echo 'alert ("Something went wrong! Try Again.");';
        echo 'window.location.href = "Sign-Up.php" ';
        echo '</script>';
        exit();
    }
	}
}
?>
