<?php
session_start();
include "database/function.php";

// Check if the necessary data is provided
if (isset($_POST['fname'], $_POST['subject'], $_POST['level'], $_POST['timeSlot'], $_POST['approvel'], $_POST['uuid'], $_POST['date'])) {
    $fname = $_POST['fname'];
    $subject = $_POST['subject'];
    $level = $_POST['level'];
    $timeSlot = $_POST['timeSlot'];
    $approvel = $_POST['approvel'];
    $uuid = $_POST['uuid'];
    $date = $_POST['date'];
   
    insertLesson($uuid, $timeSlot,  $subject, $level, $approvel, $fname, $date);
} else {
    echo "Error: Missing lesson details.";
}
?>
