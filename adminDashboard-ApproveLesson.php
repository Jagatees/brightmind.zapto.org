<?php
session_start();
include "database/function.php";

// Check if lessonId and approvalStatus are set
if (isset($_POST['lessonId']) && isset($_POST['approvalStatus'])) {
    // Get lessonId and approvalStatus from POST data
    $lessonId = $_POST['lessonId'];
    $approvalStatus = $_POST['approvalStatus'];

    // Call updateLessonApproval function
    updateLessonApproval($lessonId, $approvalStatus);
    // You may want to return a success message if needed
    echo "Lesson approval status updated successfully.";
} else {
    // Handle if lessonId or approvalStatus is not set
    echo "Error: lessonId or approvalStatus is not set.";
}
?>
