
<?php

include "database/connect.php";



function getAllUsers() {
    $users = []; 

    $conn = getDbConnection();

    $sql = "SELECT fname, lname, age, bio, subject FROM `tuition_centre`.`user`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $user = [ 
                'fname' => $row['fname'],
                'lname' => $row['lname'],
                'subject' => isset($row['subject']) ? $row['subject'] : '',
                'age' => $row['age'],
                'bio' => $row['bio']
            ];
            $users[] = $user;
        }
    } else {
        echo "0 results";
    }
    $conn->close();

    return $users;
}


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



function getlessons() {
    $teachers = [];

    $conn = getDbConnection();

    // Adjust the column names according to your table structure
    // Add a WHERE clause to filter users by role
    $sql = "SELECT idlessons, idteacher, time_slot, module, level, approvel FROM `tuition_centre`.`lessons`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Create an associative array that matches your expected structure
            $teacher = [
                'idlessons' => $row['idlessons'],
                'idteacher' => $row['idteacher'],
                'time_slot' => $row['time_slot'],
                'module' => $row['module'],
                'level' => $row['level'],
                'approvel' => $row['approvel']

            ];
            $teachers[] = $teacher;
        }
    } else {
        echo "0 results";
    }
    $conn->close();

    return $teachers;
}


function updateLessonApproval($lessonId, $approvalStatus) {
    // Establish database connection
    $conn = getDbConnection();

    // Prepare the SQL statement to update the approvel column based on the lessonId
    $sql = "UPDATE `tuition_centre`.`lessons` SET approvel = ? WHERE idlessons = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("ii", $approvalStatus, $lessonId);

    // Execute the statement and check for success/failure
    if ($stmt->execute()) {
        echo "Lesson approval status updated successfully.";
    } else {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}


function deleteUserByDetails($fname, $lname, $subject) {
    // Establish database connection
    $conn = getDbConnection();
    
    // Prepare the SQL statement to delete a user where fname, lname, and subject match
    $sql = "DELETE FROM `tuition_centre`.`user` WHERE fname = ? AND lname = ? AND subject = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    
    // Bind parameters to the prepared statement
    $stmt->bind_param("sss", $fname, $lname, $subject);
    
    // Execute the statement and check for success/failure
    if ($stmt->execute()) {
        // Check how many rows were affected
        if ($stmt->affected_rows > 0) {
            echo "User deleted successfully.";
        } else {
            echo "No user found with the specified details.";
        }
    } else {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
    
    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}




?>