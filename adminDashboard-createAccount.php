<?php
session_start();
include "database/function.php";

// Check if the necessary data is provided
if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    insertRole($fname, $lname, $email, $password, "teacher", 'bio', 0, 0, 'subject');
} else {
    echo "Error: Missing user details.";
}
?>
