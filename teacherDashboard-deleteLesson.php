<?php
session_start();
include "database/function.php";

// Check if the necessary data is provided
if (isset($_POST['lessonID'])) {
    $lessonID = $_POST['lessonID'];
    
    deleteLesson($lessonID);
} else {
    echo "Error: Missing lesson details.";
}
?>
