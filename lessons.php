<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bright Minds Academy - Lessons</title>
    <?php
    include "components/nav-bar/nav.php";
    include "inc/head.inc.php"; // Include head components
    //include "../db.php"; // Include database connection
    ?>
    <link rel="stylesheet" href="css/lessons.css">
</head>
<body>
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
    <br>
    <?php include "inc/footer.inc.php"; // Include footer components ?>

    <script src="js/lesson.js"></script>
</body>
</html>
