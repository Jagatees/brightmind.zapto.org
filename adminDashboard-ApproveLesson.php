<?php
session_start();
include "database/function.php";

if (isset($_POST['lessonId']) && isset($_POST['approvalStatus'])) {
    $lessonId = $_POST['lessonId'];
    $approvalStatus = $_POST['approvalStatus'];

    updateLessonApproval($lessonId, $approvalStatus);
    echo "Lesson approval status updated successfully.";
} else {
    echo "Error: lessonId or approvalStatus is not set.";
}
?>
