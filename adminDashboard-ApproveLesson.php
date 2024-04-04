<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header('Location: home.php');
    exit;
}
include "database/function.php";

if (isset($_POST['uuid']) && isset($_POST['approvalStatus'])) {
    $uuid = $_POST['uuid'];
    $approvalStatus = $_POST['approvalStatus'];

    // Call the function to update the lesson approval status with the uuid
    updateLessonApproval($uuid, $approvalStatus);
    echo "Lesson approval status updated successfully.";
} else {
    echo "Error: uuid or approvalStatus is not set.";
}

?>