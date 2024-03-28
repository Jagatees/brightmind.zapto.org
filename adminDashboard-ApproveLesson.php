<?php
session_start();
include "database/function.php";

if (isset($_POST['lesson_id']) && isset($_POST['approvalStatus'])) {
    $lesson_id = $_POST['lesson_id'];
    $approvalStatus = $_POST['approvalStatus'];

    updateLessonApproval($lesson_id, $approvalStatus);
    echo "Lesson approval status updated successfully.";
} else {
    echo "Error: lessonId or approvalStatus is not set.";
}
?>
