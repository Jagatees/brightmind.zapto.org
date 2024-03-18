<?php
$fname = $email = $lname = $errorMsg = $pwd = $role = "";
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

// Ensure last name is provided
if (empty($_POST["fname"])) {
    $errorMsg .= "Last Name is required.<br>";
    $success = false;
} else {
    $fname = sanitize_input($_POST["fname"]);
}

// Ensure last name is provided
if (empty($_POST["lname"])) {
    $errorMsg .= "Last Name is required.<br>";
    $success = false;
} else {
    $lname = sanitize_input($_POST["lname"]);
}

// Updated line to match the HTML form:
    if (empty($_POST["password"])) {
        $errorMsg .= "Password is required.<br>";
        $success = false;
    } else {
        $pwd = sanitize_input($_POST["password"]);
        // Your existing code for password confirmation and hashing follows here
    }

// Check if password confirmation matches
if (empty($_POST["pwd_confirm"])) {
    $errorMsg .= "Confirm Password is required.<br>";
    $success = false;
} else if ($_POST["password"] !== $_POST["pwd_confirm"]) {
    $errorMsg .= "Passwords do not match.<br>";
    $success = false;
} else {
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
}

// Final output based on success
if ($success) {
    saveMemberToDB($fname ,$lname, $email, $pwd, $role);
    session_start();
    $_SESSION['user_logged_in'] = true;
    $_SESSION['fname'] = $fname;
    $_SESSION['role'] = $role; 
    header('Location: welcome.php');
    exit; //
} else {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "<h4 class='alert-heading'>Oops!</h4>";
    echo "<p>The following errors were detected:</p>";
    echo "<hr>";
    echo "<ul>";
    foreach (explode("<br>", $errorMsg) as $message) {
        if (!empty($message)) {
            echo "<li>" . htmlspecialchars($message) . "</li>";
        }
    }
    echo "</ul>";
    echo "<a href='register.php' class='btn btn-primary'>Return to Sign Up</a>";
    echo "</div>";
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
function saveMemberToDB($fname, $lname, $email, $pwd_hashed, $role)
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

    $tableName = "`tuition_centre`.`{$role}`";
    $stmt = $conn->prepare("INSERT INTO $tableName (fname, lname, email, password, role) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("sssss", $fname, $lname, $email, $pwd_hashed, $role);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>