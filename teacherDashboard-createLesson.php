<?php
session_start();
include "database/function.php";

if (isset($_POST['fname'], $_POST['subject'], $_POST['level'], $_POST['timeSlot'], $_POST['approvel'], $_POST['uuid'], $_POST['date'], $_POST['price'])) {
    $fname = $_POST['fname'];
    $subject = $_POST['subject'];
    $level = $_POST['level'];
    $timeSlot = $_POST['timeSlot'];
    $approvel = $_POST['approvel'];
    $uuid = $_POST['uuid'];
    $date = $_POST['date'];
    $price = $_POST['price'];
   
    insertLesson($uuid, $timeSlot,  $subject, $level, $approvel, $fname, $date, $price);
} else {
    echo "Error: Missing lesson details.";
}
?>
