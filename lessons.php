<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bright Minds Academy - Lessons</title>
    <link rel="stylesheet" href="css/lessons.css">
    <?php
        include "inc/head.inc.php";
    ?>
</head>
<body>
<?php include "inc/header.inc.php"; ?>
<div id="main">
    <div class="container">
        <div class="row">
            <h4>Book Lessons</h4>
            <br><br>
            <div class="col-sm-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        P3 math
                    </div>
                    <div class="card-body">
                        <p class="card-text">Tutor: john</p>
                        <a href="#" class="btn btn-light">1:00pm - 3:00pm</a>
                        <br><br>
                        <a href="#" class="btn btn-light">3:00pm - 5:00pm</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        P3 English
                    </div>
                    <div class="card-body">
                        <p class="card-text">Tutor: john</p>
                        <a href="#" class="btn btn-light">1:00pm - 3:00pm</a>
                        <br><br>
                        <a href="#" class="btn btn-light">3:00pm - 5:00pm</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        P3 Science
                    </div>
                    <div class="card-body">
                        <p class="card-text">Tutor: john</p>
                        <a href="#" class="btn btn-light">1:00pm - 3:00pm</a>
                        <br><br>
                        <a href="#" class="btn btn-light">3:00pm - 5:00pm</a>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <?php if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] && $_SESSION['role'] == 'students'): ?>
        <a href="#" class="btn btn-light">Book now</a>
    <?php else: ?>
    <?php endif; ?>
    
</main>
    <br>
    <?php include "inc/footer.inc.php"; // Include footer components ?>

    <script src="js/create_lesson.js"></script>
</body>
</html>
