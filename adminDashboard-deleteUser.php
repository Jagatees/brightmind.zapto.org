<?php
session_start();
include "database/function.php";

// Check if the necessary data is provided
if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['subject'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $subject = $_POST['subject'];
    
    // Call the function to delete the user
    deleteUserByDetails($fname, $lname, $subject);
} else {
    echo "Error: Missing user details.";
}
?>
