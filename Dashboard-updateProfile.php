<?php
session_start();
include "database/function.php";

// Check if the necessary data is provided
if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['bio'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $bio = $_POST['bio'];

    updateUserNames($fname, $lname, $bio);
} else {
    echo "Error: Missing user details.";
}
?>
