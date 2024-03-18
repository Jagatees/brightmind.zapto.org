
<?php
function getDbConnection()
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

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}


function insertIntoTable($name, $age, $bio, $subject, $price) {
    $response = [
        'success' => false,
        'message' => ''
    ];

    $conn = getDbConnection();

    $stmt = $conn->prepare("INSERT INTO `tuition_centre`.`teacher` 
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

    $sql = "SELECT name, age, bio, subject, price FROM `tuition_centre`.`teacher`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $teachers[] = $row;
        }
    } else {
        echo "0 results";
    }
    $conn->close();

    return $teachers;
}
