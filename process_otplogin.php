<?php
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header('Location: login.php');
    exit;
}
session_start(); // Ensure session start is at the top
require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Initialize variables
$email = $otp = $errorMsg = $emailError = $otpError = "";
$success = true;
$loginsuccess = false;


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

if (!empty($_SESSION['otp'])) {
    if (time() - $_SESSION['otpCreated'] > 300) {
        $otpError = "OTP Expired";
        unset($_SESSION['otp']);
        unset($_SESSION['otpCreated']);
        $success = false;
    } else {
        if (empty($_POST["otp"])) {
            $errorMsg .= "OTP is required.<br>";
            $otpError = "OTP is required.";
            $success = false;
        } else {
            $otp = sanitize_input($_POST["otp"]);
            authenticateUser($email, $otp);
        }
    }
} else {
    if ($success) {
        mailUserOTP($email);
    }
}

if ($loginsuccess) {
    unset($_SESSION['otp']);
    unset($_SESSION['otpCreated']);
    header('Location: home.php'); 
    exit();
} elseif ($success) {
    $_SESSION['email'] = $_POST['email'];
    header('Location: otplogin.php');
    exit();
} else {
    $_SESSION['emailError'] = $emailError;
    $_SESSION['otpError'] = $otpError;
    $_SESSION['email'] = $_POST['email'];
    header('Location: otplogin.php');
    exit();
}

function mailUserOTP($email) {
    global $success, $emailError;

    $config = parse_ini_file('/var/www/private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        $success = false;
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT fname, email FROM `tuition_centre`.`user` WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fname = $row['fname'];
        // Generate otp and send to email
        $_SESSION['otp'] = sprintf("%06d", mt_rand(1, 999999));
        $_SESSION['otpCreated'] = time();
        $msg = "Hi " . $fname . "! Your login otp is " . $_SESSION['otp'] . ". It will expire in 5 minutes.";
        
        $mail = new PHPMailer(true);
        $mail -> isSMTP();
        $mail -> SMTPAuth = true;
        $mail -> Host = "smtp.mailersend.net";
        $mail -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail -> Port = 587;
        $mail -> Username = "MS_8EhjDa@trial-vywj2lpzxomg7oqz.mlsender.net";
        $mail -> Password = "FWNoVsYHBD9JWkg7";
        $mail -> setFrom("MS_8EhjDa@trial-vywj2lpzxomg7oqz.mlsender.net", "Brightmind Admin");
        $mail -> addAddress($email, $fname);
        $mail -> Subject = "BrightMind Login";
        $mail -> Body = $msg;
        $mail -> send();
    } else {
        $success = false;
        $emailError = "Email not found.";
    }

    $stmt->close();
    $conn->close();
}

function authenticateUser($email, $otp) {
    global $success, $loginsuccess, $otpError;

    if ($otp == $_SESSION['otp']) {
        $config = parse_ini_file('/var/www/private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        
        if ($conn->connect_error) {
            $success = false;
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT fname, lname, role, bio, uuid FROM `tuition_centre`.`user` WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        $_SESSION['user_logged_in'] = true;
        $_SESSION['fname'] = $row["fname"];
        $_SESSION['lname'] = $row["lname"];
        $_SESSION['uuid'] = $row["uuid"];
        $_SESSION['role'] = $row["role"]; 
        $_SESSION['bio'] = $row["bio"]; 

        $stmt->close();
        $conn->close();

        $success = true;
        $loginsuccess = true;
    } else {
        $otpError = "Incorrect OTP.";
        $success = false;
    }

    
}
?>
