<?php
session_start(); // Ensure session start is at the top


// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Initialize variables
$email = $pwd = $errorMsg = "";
$success = true;


$emailError = "";
// Sanitize and validate the email
if (empty($_POST["email"])) {
    $errorMsg .= "Email is required.<br>";
    $emailError = "Email is required.";
    $success = false;
} else {
    $email = sanitize_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
        $errorMsg .= "Invalid email format.<br>";
        $success = false;
    }
}

$pwError = "";
if (empty($_POST["password"])) {
    $errorMsg .= "Password is required.<br>";
    $pwError = "Password is required.";
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
    $_SESSION['email'] = $email; // Keep email input
    $_SESSION['emailError'] = $emailError;
    $_SESSION['pwError'] = $pwError;
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    header('Location: login.php');
    exit();
}

function authenticateUser($email, $pwd) {
    global $success, $emailError, $pwError;

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
            $pwError = "Incorrect password.";
        }
    } else {
        $success = false;
        $emailError = "Email not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
