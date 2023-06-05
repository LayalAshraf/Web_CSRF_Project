<?php
    // Create Connection
    $conn = mysqli_connect('localhost', 'root', '1234', 'Music_House'); //add your name in username 

    // Check Connection
    if(mysqli_connect_errno()){
        // Connection Failed
        die("Failed to connect to MySQL");
    }
?>
