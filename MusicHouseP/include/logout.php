<?php
session_start();
if(session_destroy()) // Destroying all sessions
{
    header("Location: Home.php"); // Redirecting to Home Page
}
?>