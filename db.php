
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

    // Establish database connection
    $conn = getDbConnection();

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO `tuition_centre`.`teacher` (name, age, bio, subject, price) VALUES (?, ?, ?, ?, ?)");

    // Bind the parameters to the SQL query
    $stmt->bind_param("sisss", $name, $age, $bio, $subject, $price); // 's' denotes a string, 'i' denotes an integer

    // Execute the statement
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Data inserted successfully.';
    } else {
        $response['message'] = 'Failed to insert data.';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    return $response;
}
