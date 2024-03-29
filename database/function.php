
<?php

include "database/connect.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);


function getAllUsers() {
    $users = []; 

    $conn = getDbConnection();

    // Modify the SQL to include a WHERE clause that filters by role
    $sql = "SELECT fname, lname, age, bio, subject FROM `tuition_centre`.`user` WHERE role IN ('student', 'teacher')";
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


function insertRole($fname, $lname, $email, $pwd_hashed, $role, $bio, $age, $price, $subject, $uuid) {

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
    $stmt = $conn->prepare("INSERT INTO $tableName (fname, lname, email, password, role, bio, age, price, subject, uuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $age = (int)$age;
    $price = (float)$price;

    $stmt->bind_param("ssssssssss", $fname, $lname, $email, $pwd_hashed, $role, 
    $bio, $age, $price, $subject, $uuid);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}



function getlessons() {
    $lessons = []; 

    $conn = getDbConnection();

    $sql = "SELECT lesson_id, uuid, time_slot, module, level, approvel, teacher_name FROM `tuition_centre`.`lessons`";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Create an associative array that matches your expected structure
            $lesson = [
                'lesson_id' => $row['lesson_id'],
                'uuid' => $row['uuid'],
                'time_slot' => $row['time_slot'],
                'module' => $row['module'],
                'level' => $row['level'],
                'approvel' => $row['approvel'],
                'teacher_name' => $row['teacher_name']
            ];
            $lessons[] = $lesson;
        }
    } else {
        echo "0 results";
    }
    $conn->close();

    return $lessons;
}

function getlessonsUUID($uuid) {
    $lessons = []; 

    $conn = getDbConnection();

    // Prepare SQL statement with a WHERE clause to filter lessons by UUID
    $sql = "SELECT lesson_id, uuid, time_slot, module, level, approvel, teacher_name FROM `tuition_centre`.`lessons` WHERE uuid = '$uuid'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Create an associative array that matches your expected structure
            $lesson = [
                'lesson_id' => $row['lesson_id'],
                'uuid' => $row['uuid'],
                'time_slot' => $row['time_slot'],
                'module' => $row['module'],
                'level' => $row['level'],
                'approvel' => $row['approvel'],
                'teacher_name' => $row['teacher_name']
            ];
            $lessons[] = $lesson;
        }
    } else {
        echo "0 results";
    }
    $conn->close();

    return $lessons;
}



function updateLessonApproval($uuid, $approvalStatus) {
    // Establish database connection
    $conn = getDbConnection();

    // Prepare the SQL statement to update the approval column based on uuid
    $sql = "UPDATE `tuition_centre`.`lessons` SET approvel = ? WHERE uuid = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Bind parameters to the prepared statement
    // Assuming approvalStatus is an integer and uuid is a string
    $stmt->bind_param("is", $approvalStatus, $uuid);

    // Execute the statement and check for success/failure
    if ($stmt->execute()) {
        echo "Lesson approval status updated successfully for UUID: " . htmlspecialchars($uuid) . ".";
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


function updateUserNames($newFname, $newLname) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $currentFname = isset($_SESSION['fname']) ? $_SESSION['fname'] : '';
    $currentLname = isset($_SESSION['lname']) ? $_SESSION['lname'] : '';

    $conn = getDbConnection();

    $sql = "UPDATE `tuition_centre`.`user` SET fname = ?, lname = ? WHERE fname = ? AND lname = ?";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("ssss", $newFname, $newLname, $currentFname, $currentLname);

    $success = false;
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "User name updated successfully.";
            $success = true;
        } else {
            echo "No user found with the specified details or no change was made.";
        }
    } else {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    $stmt->close();
    $conn->close();

    if ($success) {
        $_SESSION['fname'] = $newFname;
        $_SESSION['lname'] = $newLname;
    }
}

function insertLesson($uuid, $timeSlot, $module, $level, $approvel, $teacherId) {
    // Establish database connection
    $conn = getDbConnection();
    
    // Prepare the SQL statement to insert a lesson
    $sql = "INSERT INTO `tuition_centre`.`lessons` (uuid, time_slot, module, level, approvel, teacher_name) 
    VALUES (?, ?, ?, ?, ?, ?)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    
    // Bind parameters to the prepared statement
    $stmt->bind_param("ssssis", $uuid, $timeSlot, $module, $level, $approvel, $teacherId);
    
    // Execute the statement and check for success/failure
    if ($stmt->execute()) {
        echo "Lesson inserted successfully.";
    } else {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
    
    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}




?>