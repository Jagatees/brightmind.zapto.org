<?php

$teacher_id = $module = $level = $all_time_slot = "";
$success = true;

$teacher_id = $_POST["teacherName"];

if (empty($_POST["module"])) {
    $errorMsg .= "Module is required.<br>";
    $success = false;
} else {
    $module = sanitize_input($_POST["module"]);
}

if (empty($_POST["level"])) {
    $errorMsg .= "Level is required.<br>";
    $success = false;
} else {
    $level = sanitize_input($_POST["level"]);
}

if (empty($_POST["timeSlots"])) {
    $errorMsg .= "Please select at least 1 time slot.<br>";
    $success = false;
} else {
    $all_time_slot = sanitize_input($_POST["timeSlots"]);
}

$time_slot_array = explode("|", $all_time_slot);


if ($success) {
    foreach ($time_slot_array as $time_slot)
    {
        if ($time_slot != NULL OR $time_slot != '')
        {
            createLesson($teacher_id, $module, $level, $time_slot);
        }
    }
    header('Location: success.php');
    exit;
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
    echo "<a href='create_lessons.php' class='btn btn-primary'>Return to create lessons.</a>";
    echo "</div>";
}


function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function createLesson($teacher_id, $module, $level, $time_slot)
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

    $tableName = "`tuition_centre`.`lessons`";
    $stmt = $conn->prepare("INSERT INTO $tableName (idteacher, time_slot, module, level) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("isss", $teacher_id, $time_slot, $module, $level);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}

?> 

?>