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

if (empty($_POST["password"])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
} else {
    $pwd = sanitize_input($_POST["password"]);
}

if ($success) {
    authenticateUser($email, $pwd);
}

if ($success) {
    header('Location: home.php'); 
    exit();
} else {
    $_SESSION['emailError'] = $errorMsg;
    $_SESSION['email'] = $email; // Keep email input
    header('Location: login.php');
    exit();
}

function authenticateUser($email, $pwd) {
    global $success;

    $config = parse_ini_file('/var/www/private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
    if ($conn->connect_error) {
        $success = false;
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT fname, lname, password, role, bio, uuid FROM `tuition_centre`.`user` WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pwd, $row["password"])) {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['fname'] = $row["fname"];
            $_SESSION['lname'] = $row["lname"];
            $_SESSION['uuid'] = $row["uuid"];
            $_SESSION['role'] = $row["role"]; 
            $_SESSION['bio'] = $row["bio"]; 

        } else {
            $success = false;
            $_SESSION['pwError'] = "Incorrect password.";
        }
    } else {
        $success = false;
        $_SESSION['emailError'] = "Email not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
