<?php
session_start(); // Ensure session start is at the top


// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Initialize variables
$email = $pwd = $errorMsg = "";
$success = true;

// Sanitize and validate the email
if (empty($_POST["email"])) {
    $errorMsg .= "Email is required.<br>";
    $success = false;
} else {
    $email = sanitize_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Invalid email format.<br>";
        $success = false;
    }
}

// Sanitize and validate the password
if (empty($_POST["password"])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
} else {
    $pwd = sanitize_input($_POST["password"]);
}

// Authenticate user if validation successful
if ($success) {
    authenticateUser($email, $pwd);
}

// Redirect or store error messages in session
if ($success) {
    header('Location: welcome.php'); 
    exit();
} else {
    $_SESSION['emailError'] = $errorMsg;
    $_SESSION['email'] = $email; // Keep email input
    header('Location: login.php');
    exit();
}

// Function to authenticate user and retrieve role
function authenticateUser($email, $pwd) {
    global $success;

    // Database connection
    $config = parse_ini_file('/var/www/private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
    // Check connection
    if ($conn->connect_error) {
        $success = false;
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT fname, lname, password, role, uuid FROM `tuition_centre`.`user` WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pwd, $row["password"])) {
            // Password is correct, set session variables
            $_SESSION['user_logged_in'] = true;
            $_SESSION['fname'] = $row["fname"];
            $_SESSION['lname'] = $row["lname"];
            $_SESSION['uuid'] = $row["uuid"];
            $_SESSION['role'] = $row["role"]; // Retrieve role from DB and store in session
        } else {
            // Password doesn't match
            $success = false;
            $_SESSION['pwError'] = "Incorrect password.";
        }
    } else {
        // Email not found
        $success = false;
        $_SESSION['emailError'] = "Email not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
