<?php
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header('Location: login.php');
    exit;
}
$pwd = "";
$pwError = $cpwError = "";
$success = true;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Updated line to match the HTML form:
if (empty($_POST["password"])) {
    $errorMsg .= "Password is required.<br>";
    $pwError = "Password is required.";
    $success = false;
} else {
    $pwd = sanitize_input($_POST["password"]);
    // Check if password confirmation matches
    if (empty($_POST["pwd_confirm"])) {
        $errorMsg .= "Confirm Password is required.<br>";
        $cpwError = "Confirm Password is required.";
        $success = false;
    } else if ($_POST["password"] !== $_POST["pwd_confirm"]) {
        $errorMsg .= "Passwords do not match.<br>";
        $cpwError = "Passwords do not match.";
        $success = false;
    } else {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }
}

session_start();
// Final output based on success
if ($success) {
    savePasswordToDB($_SESSION['uuid'], $pwd);
    $_SESSION['success'] = true;
    header('Location: changepassword.php');
    exit();
} else {
    $_SESSION['pwError'] = $pwError;
    $_SESSION['cpwError'] = $cpwError;
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['cpassword'] = $_POST['pwd_confirm'];
    header('Location: changepassword.php');
    exit();
}

/*
 * Helper function that checks input for malicious or unwanted content.
 */
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


/*
 * Helper function to write the member data to the database.
 */
function savePasswordToDB($uuid, $pwd_hashed)
{

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

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $tableName = "`tuition_centre`.`user`";
    $stmt = $conn->prepare("UPDATE $tableName SET password = ? WHERE uuid = ?");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("ss", $pwd_hashed, $uuid);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>