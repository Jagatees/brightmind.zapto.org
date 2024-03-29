<?php
session_start();
include "database/function.php";

// Check if the necessary data is provided
if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['uuid']) && isset($_POST['subject']) && isset($_POST['bio']) && isset($_POST['age']) && isset($_POST['price'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $uuid = $_POST['uuid'];
    $subject = $_POST['subject']; // New subject obtained from the form
    $bio = $_POST['bio']; // New bio obtained from the form
    $age = $_POST['age']; // New age obtained from the form
    $price = $_POST['price']; // New price obtained from the form

    $pwd = password_hash($password, PASSWORD_DEFAULT);

    // Call insertRole function with the additional parameters
    insertRole($fname, $lname, $email, $pwd, "teacher", $bio, $age, $price, $subject, $uuid); // Replace 'subject' with the new subject
} else {
    echo "Error: Missing user details.";
}
?>
<script>
function validateForm() {
    var email = document.getElementById('email').value; // Make sure your email input has an id of 'email'
    if (!email.includes('@')) {
        alert("@ is required in the email field.");
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}
</script>