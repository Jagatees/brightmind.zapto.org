<?php
session_start();
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true)) {
    header('Location: login.php');
    exit; // Make sure to terminate the script
}

include "database/function.php";

$lessons = getlessons();
$allLessonsJSON = json_encode($lessons, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bright Minds Academy - Lessons</title>
    <link rel="stylesheet" href="css/lessons.css">
    <?php include "inc/head.inc.php"; ?>
</head>
<body>
    <?php include "inc/header.inc.php"; ?>
    <div id="main">
        <div class="container">
            <div class="row">
                <h4>Book Lessons</h4>
                <br><br>
                <div id="lessonCardsContainer" class="row"></div>
            </div>
        </div>        
    </div>
    <?php if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] && $_SESSION['role'] == 'student'): ?>
        <a href="#" class="btn btn-light">Book now</a>
    <?php endif; ?>
    <br>
    <?php include "inc/footer.inc.php"; ?>
    <script>
        // JavaScript to dynamically load lesson cards
        var lessonsData = <?php echo $allLessonsJSON; ?>;

        var lessonCardsContainer = document.getElementById('lessonCardsContainer');

        lessonsData.forEach(function(lesson) {
            var cardDiv = document.createElement('div');
            cardDiv.classList.add('col-sm-4');

            var cardHTML = `
                <div class="card" style="width: 18rem;">
                    <div class="card-header">Subject :${lesson.module}</div>
                    <div class="card-body">
                        <p class="card-text">Tutor Name: ${lesson.teacher_name}</p>
                        <a href="#" class="btn btn-light">${lesson.time_slot}</a>
                        <br><br>
                        <!-- You can add additional buttons or content here if needed -->
                    </div>
                </div>
            `;

            cardDiv.innerHTML = cardHTML;
            lessonCardsContainer.appendChild(cardDiv);
        });
    </script>
</body>
</html>
