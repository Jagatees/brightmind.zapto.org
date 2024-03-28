<?php
session_start(); // Start the session at the beginning of the file

$fname = $email = $lname = $errorMsg = $pwd = $role =  "";
$success = true;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Define an array of valid roles
$validRoles = ['student', 'teacher', 'admin'];

// Sanitize the input
$role = sanitize_input($_POST["role"]);

// Check if the role is valid
if (empty($role)) {
    $errorMsg .= "Role is required.<br>";
    $success = false;
} else if (!in_array($role, $validRoles)) {
    // If the role is not in the array of valid roles
    $errorMsg .= "Invalid role selected.<br>";
    $success = false;
}

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

if ($success) {
    authenticateUser();
}

if ($success) {
    // Store user info in session variable
    session_start();
    $_SESSION['user_logged_in'] = true;
    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['role'] = $role; 
    header('Location: welcome.php'); 
    exit();
} else {
    echo $errorMsg;
}


function authenticateUser() {
    global $fname, $lname, $email, $pwd, $errorMsg, $success, $role;


     // Check to Prevent Error
     $allowedTypes = ['student', 'teacher', 'admin'];

     if (!in_array($role, $allowedTypes)) {
         die("Invalid type specified.");
     }

    $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config) {
        die("Failed to read database config file.");
    }

    $conn = new mysqli(
        $config['servername'],
        $config['username'],
        $config['password'],
        $config['dbname']
    );

    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
        return;
    }

    $tableName = "`tuition_centre`.`user`";

    // Prepare and execute query to authenticate user
    $stmt = $conn->prepare("SELECT fname, lname, email, password, role FROM $tableName WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fname = $row["fname"];
        $lname = $row["lname"];
        $pwd_hashed = $row["password"];
        if ($pwd_hashed !== null && $pwd !== null && password_verify($pwd, $pwd_hashed)) {
            // Password verified, authentication successful
            // You may want to store additional user information in session variables here
            $_SESSION['user_name'] = $fname . ' ' . $lname;
        } else {
            // Password doesn't match
            $errorMsg = "Email found but password doesn't match.";
            $success = false;
        }
    } else {
        // Email not found
        $errorMsg = "Email not found.";
        $success = false;
    }

    $stmt->close();
    $conn->close();
}
?>
