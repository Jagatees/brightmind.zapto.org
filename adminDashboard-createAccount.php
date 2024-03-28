<?php
session_start();
include "database/function.php";

// Check if the necessary data is provided
if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['uuid'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $uuid = $_POST['uuid'];

    insertRole($fname, $lname, $email, $password, "teacher", 'bio', 0, 0, 'subject', $uuid);
} else {
    echo "Error: Missing user details.";
}
?>
