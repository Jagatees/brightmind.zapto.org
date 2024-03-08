<?php
$fname = $email = $lname = $errorMsg = $pwd = "";
$success = true;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// Sanitize and validate the password
if (empty($_POST["pwd"])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
} else {
    $pwd = sanitize_input($_POST["pwd"]);
}

// Check if password confirmation matches
if (empty($_POST["pwd_confirm"])) {
    $errorMsg .= "Confirm Password is required.<br>";
    $success = false;
} else if ($_POST["pwd"] !== $_POST["pwd_confirm"]) {
    $errorMsg .= "Passwords do not match.<br>";
    $success = false;
} else {
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
}

// Final output based on success
if ($success) {
    echo "<div class='alert alert-success'>";
    echo "<h4 class='alert-heading'>Your registration is successful!</h4>";
    echo "<p>Thank you for signing up, " . htmlspecialchars($lname) . ".</p>";
    echo "<hr>";
    echo "<a href='register.php' class='btn btn-primary'>Log in</a>";
    echo "</div>";
    saveMemberToDB($fname ,$lname, $email, $pwd);
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
function saveMemberToDB($fname, $lname, $email, $pwd_hashed)
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

    // Prepare the SQL statement and check for errors
    $stmt = $conn->prepare("INSERT INTO world_of_pets_members (fname, lname, email, password) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("ssss", $fname, $lname, $email, $pwd_hashed);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>