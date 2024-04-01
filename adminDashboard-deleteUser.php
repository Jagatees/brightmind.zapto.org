<?php
session_start();
include "database/function.php";

// Check if the necessary data is provided
if (isset($_POST['fname']) && isset($_POST['lname'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    
    // Call the function to delete the user
    deleteUserByDetails($fname, $lname);
} else {
    echo "Error: Missing user details.";
}
?>
