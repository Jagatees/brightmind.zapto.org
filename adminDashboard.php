<?php
session_start();
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true)) {
    header('Location: login.php');
    exit; // Make sure to terminate the script
}

include "database/function.php";
$lessons = getlessons();
$allLessonsJSON = json_encode($lessons); // Encode the lessons array as JSON
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bright Minds Academy</title>
    <?php include "inc/head.inc.php"; ?>
</head>
<body>
<div id="main">

    <?php include "inc/header.inc.php"; ?>
    <div id="menu">
        <button onclick="approveLesson()">Approve Lesson</button>
    </div>
    <div id="content">
        <h1>Welcome Page</h1>
        <p>Click the buttons on the left to view different content here.</p>
    </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
    <script>
        var allLessons = JSON.parse('<?php echo $allLessonsJSON; ?>');

        function approveLesson() {
            var contentDiv = document.getElementById('content');
            contentDiv.innerHTML = '<h2>Lessons</h2>';
            allLessons.forEach(function(lesson) {
                contentDiv.innerHTML += '<p><strong>ID:</strong> ' + lesson.idlessons + '</p>';
                contentDiv.innerHTML += '<p><strong>Teacher ID:</strong> ' + lesson.idteacher + '</p>';
                contentDiv.innerHTML += '<p><strong>Time Slot:</strong> ' + lesson.time_slot + '</p>';
                contentDiv.innerHTML += '<p><strong>Module:</strong> ' + lesson.module + '</p>';
                contentDiv.innerHTML += '<p><strong>Level:</strong> ' + lesson.level + '</p>';
                contentDiv.innerHTML += '<p><strong>approvel:</strong> ' + lesson.approvel + '</p>';
                contentDiv.innerHTML +=  '<button>Approve</button>';
                contentDiv.innerHTML +=  '<button>Do Not Approve</button>';
                contentDiv.innerHTML += '<hr>'; 
            });
        }
    </script>
</body>
</html>