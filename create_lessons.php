<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bright Minds Academy - Create Lessons</title>
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
            <h4>Create Lessons</h4>
            <br><br>
            <form method="post" class="form" action="process_create_lessons.php">
                <div class="form-group row">
                    <label for="teacherName" class="col-sm-2 col-form-label">Teacher name</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="teacherName" name="teacherName" value="1">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="timeSlots" class="col-sm-2 col-form-label">Time slots</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <a href="#" id="8:00am - 10:00am" class="btn btn-light">8:00am - 10:00am</a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#" class="btn btn-light">10:00am - 12:00pm</a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#" class="btn btn-light">12:00pm - 2:00pm</a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#" class="btn btn-light">2:00pm - 4:00pm</a>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <a href="#" class="btn btn-light">4:00pm - 6:00pm</a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#" class="btn btn-light">6:00pm - 8:00pm</a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#" class="btn btn-light">8:00pm - 10:00pm</a>
                            </div>
                        </div>
                        <br>
                    </div>
                    <input type="text" id="timeSlots" value="" name="timeSlots" hidden>
                </div>
                <div class="form-group row">
                    <label for="module" class="col-sm-2 col-form-label">Module</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="module" name="module" placeholder="Module">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="level" class="col-sm-2 col-form-label">Level</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="level" name="level" placeholder="P3">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="float:right;">Create</button>
            </form>
        </div>
    </div>
    <br>
    <?php include "inc/footer.inc.php"; // Include footer components ?>
    <script src="js/create_lessons.js"></script>
</body>
</html>
