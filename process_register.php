<?php
$fname = $email = $lname = $errorMsg = $pwd = $role = $uuid = "";
$success = true;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Define an array of valid roles
$validRoles = ['student', 'teacher', 'admin'];

// Sanitize the input
$role = sanitize_input($_POST["role"]);

// Check if the role is valid
if (empty($role)) {
    $errorMsg .= "Role is required.<br>";
    $roleError = "Role is required.";
    $success = false;
} else if (!in_array($role, $validRoles)) {
    // If the role is not in the array of valid roles
    $errorMsg .= "Invalid role selected.<br>";
    $roleError = "Invalid role selected.";
    $success = false;
}


// Sanitize and validate the email
if (empty($_POST["email"])) {
    $errorMsg .= "Email is required.<br>";
    $emailError = "Email is required.";
    $success = false;
} else {
    $email = sanitize_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Invalid email format.<br>";
        $emailError = "Inavlid email format.";
        $success = false;
    } else {
        checkEmailInUse($email);
    }
}

// Ensure first name is provided
if (empty($_POST["fname"])) {
    $errorMsg .= "First Name is required.<br>";
    $fnameError = "First Name is required.";
    $success = false;
} else {
    $fname = sanitize_input($_POST["fname"]);
}

// Ensure last name is provided
if (empty($_POST["lname"])) {
    $errorMsg .= "Last Name is required.<br>";
    $lnameError = "Last Name is required.";
    $success = false;
} else {
    $lname = sanitize_input($_POST["lname"]);
}

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


// Check if uuid is set
if (isset($_POST['uuid'])) {
    $uuid = $_POST['uuid'];
    // Do something with $uuid, like passing it to another function or saving it to a database
}


session_start();
// Final output based on success
if ($success) {
    saveMemberToDB($fname ,$lname, $email, $pwd, $role, $uuid);
    $_SESSION['user_logged_in'] = true;
    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['user_name'] = $fname . ' ' . $lname;
    $_SESSION['role'] = $role;
    $_SESSION['uuid'] = $uuid; 
    $_SESSION['bio'] = $row["bio"]; // Retrieve role from DB and store in session
    
    header('Location: welcome.php');
    exit; //
} else {
    // echo "<div class='alert alert-danger' role='alert'>";
    // echo "<h4 class='alert-heading'>Oops!</h4>";
    // echo "<p>The following errors were detected:</p>";
    // echo "<hr>";
    // echo "<ul>";
    // foreach (explode("<br>", $errorMsg) as $message) {
    //     if (!empty($message)) {
    //         echo "<li>" . htmlspecialchars($message) . "</li>";
    //     }
    // }
    // echo "</ul>";
    // echo "<a href='register.php' class='btn btn-primary'>Return to Sign Up</a>";
    // echo "</div>";

    $_SESSION['fnameError'] = $fnameError;
    $_SESSION['lnameError'] = $lnameError;
    $_SESSION['roleError'] = $roleError;
    $_SESSION['emailError'] = $emailError;
    $_SESSION['pwError'] = $pwError;
    $_SESSION['cpwError'] = $cpwError;
    $_SESSION['fname'] = $_POST['fname'];
    $_SESSION['lname'] = $_POST['lname'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['role'] = $_POST['role'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['cpassword'] = $_POST['pwd_confirm'];
    header('Location: register.php');
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

// Check if email already in DB
function checkEmailInUse($email) {

    global $emailError, $success;

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
    // Prepare and execute query to check if email already in DB
    $stmt = $conn->prepare("SELECT email FROM $tableName WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $emailError = "Email already in use.";
        $success = false;
    }

    $stmt->close();
    $conn->close();
}

/*
 * Helper function to write the member data to the database.
 */
function saveMemberToDB($fname, $lname, $email, $pwd_hashed, $role, $uuid)
{

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

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $tableName = "`tuition_centre`.`user`";
    $stmt = $conn->prepare("INSERT INTO $tableName (fname, lname, email, password, role, uuid) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("ssssss", $fname, $lname, $email, $pwd_hashed, $role, $uuid);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>