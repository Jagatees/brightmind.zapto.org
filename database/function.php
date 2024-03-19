
<?php

include "database/connect.php";


function getTeachers() {
    $teachers = [];

    $conn = getDbConnection();

    // Adjust the column names according to your table structure
    // Add a WHERE clause to filter users by role
    $sql = "SELECT fname, lname, age, bio, subject FROM `tuition_centre`.`user` WHERE role = 'teacher'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Create an associative array that matches your expected structure
            $teacher = [
                'fname' => $row['fname'],
                'lname' => $row['lname'],
                'subject' => $row['subject'],
                'age' => $row['age'],
                'bio' => $row['bio']
            ];
            $teachers[] = $teacher;
        }
    } else {
        echo "0 results";
    }
    $conn->close();

    return $teachers;
}



// INSERT either [student | teacher | admin] role into table (First Time)
function insertRole($fname, $lname, $email, $pwd_hashed, $role, $bio, $age, $price, $subject) {

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

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $tableName = "`tuition_centre`.`user`";
    $stmt = $conn->prepare("INSERT INTO $tableName (fname, lname, email, password, role, bio, age, price, subject) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $age = (int)$age;
    $price = (float)$price;

    $stmt->bind_param("sssssssss", $fname, $lname, $email, $pwd_hashed, $role, $bio, $age, $price, $subject);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}






?>