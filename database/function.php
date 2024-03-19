
<?php

include "database/connect.php";


function insertIntoTable($name, $age, $bio, $subject, $price) {
    $response = [
        'success' => false,
        'message' => ''
    ];

    $conn = getDbConnection();

    $stmt = $conn->prepare("INSERT INTO `tuition_centre`.`user` 
    (name, age, bio, subject, price) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("sisss", $name, $age, $bio, $subject, $price); // 's' denotes a string, 'i' denotes an integer

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Data inserted successfully.';
    } else {
        $response['message'] = 'Failed to insert data.';
    }

    $stmt->close();
    $conn->close();

    return $response;
}


function getTeachers() {
    $teachers = [];

    $conn = getDbConnection();

    // Adjust the column names according to your table structure
    $sql = "SELECT fname, lname, age, bio, subject FROM `tuition_centre`.`user`";
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


?>