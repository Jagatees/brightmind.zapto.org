<?php
session_start();
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true)) {
    header('Location: login.php');
    exit;
}

include "database/function.php";

if (isset($_SESSION['uuid'])) {
    $uuid = $_SESSION['uuid'];
    $lessons = getlessonsUUID($uuid);
    $allLessonsJSON = json_encode($lessons, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
} else {
    echo "UUID not found in session.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bright Minds Academy - Teacher Dashboard</title>
    <?php include "inc/head.inc.php"; // This should include your styles and Bootstrap 
    ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="css/teacherDashboards.css" rel="stylesheet">
    <style>
        /* Add your CSS styles here */
        .readonly {
            background-color: #f2f2f2;
            /* Gray background color */
            color: #666666;
            /* Gray text color */
            cursor: not-allowed;
            /* Change cursor to not-allowed */
        }

        /* Additional styles can be added as needed */
    </style>
</head>

<body>
    <div id="main">
        <?php include "inc/header.inc.php"; ?>
        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <span class="nav-link active">
                                    <img src="student.jpg" class="rounded-circle" width="50" height="50">
                                    <span class="ml-2"><?php echo $_SESSION['fname']; ?></span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick=" event.preventDefault(); editProfile()">
                                    Edit Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick=" event.preventDefault(); CreateLessons()">
                                    Create-Lesson
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick=" event.preventDefault(); CheckLessonApprovel()">
                                    Check-Lesson-Approval
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">
                                    Log Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div id="content">
                    </div>
                    <div id="editProfileContainer" class="container">

                    </div>

                    <div id="createLessonContainer" class="container" style="display: none;">
                        <div class="create-lesson-form">
                            <div class="row">
                                <h4>Create Lessons</h4>
                                <br><br>
                                <form id="createLessonForm">
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-2 col-form-label">Teacher name</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="fname" name="fname" required value="<?php echo htmlspecialchars($_SESSION['fname']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control-plaintext" id="date" name="date" required placeholder="DD/MM/YYYY">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="timeSlot" class="col-sm-2 col-form-label">Time slots</label>
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
                                        <input type="text" id="timeSlot" value="" name="timeSlot" hidden>
                                    </div>
                                    <div class="form-group row">
                                        <label for="subject" class="col-sm-2 col-form-label">Subject</label>
                                        <div class="col-sm-10">
                                            <select id="subject" name="subject" class="form-select" aria-label="Subject">
                                                <option value="Math" selected>Math</option>
                                                <option value="English">English</option>
                                                <option value="Science">Science</option>
                                                <option value="MotherTongue">Mother Tongue</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="level" class="col-sm-2 col-form-label">Level</label>
                                        <div class="col-sm-10">
                                            <select id="level" name="level" class="form-select" aria-label="Level">
                                                <option value="P1" selected>P1</option>
                                                <option value="P2">P2</option>
                                                <option value="P3">P3</option>
                                                <option value="P4">P4</option>
                                                <option value="P5">P5</option>
                                                <option value="P6">P6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-2 col-form-label">Price</label>
                                        <div class="col-sm-1">
                                            $
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control-plaintext" id="price" name="price" required placeholder="60">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="numOfStudent" class="col-sm-2 col-form-label">Number of Students</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="numOfStudent" name="numOfStudent" required placeholder="e.g., 10" min="1" max="10">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" onclick="createLesson()" style="float:right;">Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="checkLessonContainer" class="container checklesson-container">
                    </div>
                </main>
            </div>
        </div>
        <script src="js/add_lesson.js"></script>
        <?php include "inc/footer.inc.php"; ?>
    </div>

    <script>
        var userFirstName = <?php echo isset($_SESSION['fname']) ? json_encode($_SESSION['fname']) : json_encode(""); ?>;
        var userLastName = <?php echo isset($_SESSION['lname']) ? json_encode($_SESSION['lname']) : json_encode(""); ?>;
        var bio = <?php echo isset($_SESSION['bio']) ? json_encode($_SESSION['bio']) : json_encode(""); ?>;

        var allLessonsJSON = '<?php echo $allLessonsJSON; ?>';
        var allLessons = allLessonsJSON ? JSON.parse(allLessonsJSON) : [];

        if (allLessonsJSON) {
            var allLessons = JSON.parse(allLessonsJSON);
        } else {
            console.error('allLessonsJSON is empty or invalid');
        }

        function CheckLessonApprovel() {

            document.getElementById('content').style.display = 'none';
            document.getElementById('createLessonContainer').style.display = 'none';
            document.getElementById('editProfileContainer').style.display = 'none';

            var checkLessonContainer = document.getElementById('checkLessonContainer');
            checkLessonContainer.style.display = 'block';
            checkLessonContainer.innerHTML = '';
            allLessons.forEach(function(lesson) {
                Object.entries(lesson).forEach(([key, value]) => {
                    if (value === undefined) {
                        console.log('Undefined found for key:', key);
                    }
                });

                var cardHtml = '<div class= "checklesson-card">';
                cardHtml += '<p><strong>ID:</strong> ' + (lesson.lesson_id) + '</p>';
                cardHtml += '<p><strong>Teacher ID:</strong> ' + (lesson.uuid) + '</p>';
                cardHtml += '<p><strong>Teacher Name:</strong> ' + (lesson.teacher_name) + '</p>';
                cardHtml += '<p><strong>Time Slot:</strong> ' + (lesson.time_slot) + '</p>';
                cardHtml += '<p><strong>Module:</strong> ' + (lesson.module) + '</p>';
                cardHtml += '<p><strong>Level:</strong> ' + (lesson.level) + '</p>';
                cardHtml += '<p><strong>Approval:</strong> ' + (lesson.approvel) + '</p>';
                cardHtml += '</div>';

                checkLessonContainer.innerHTML += cardHtml;
            });
        }

        // EDIT PROFILE : START
        function editProfile() {
            var contentDiv = document.getElementById('editProfileContainer');
            contentDiv.innerHTML = '';
            contentDiv.style.display = 'block';
            document.getElementById('createLessonContainer').style.display = 'none';
            document.getElementById('checkLessonContainer').style.display = 'none';
            var formHtml = `
            <div class= "edit-prof-form">
                <h2>Edit Profile</h2>
                <form id="editProfileForm">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" class="form-control" required value="${userFirstName}">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" class="form-control" required value="${userLastName}">
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <input type="text" id="bio" name="bio" class="form-control" required value="${bio}">
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="updateProfile()">Update Profile</button>
                </form>
            </div>
            `;
            contentDiv.innerHTML = formHtml;
        }


        function updateProfile() {
            var fname = document.getElementById('fname').value;
            var lname = document.getElementById('lname').value;
            var bio = document.getElementById('bio').value;

            if (fname.trim() === '' || lname.trim() === '' || bio.trim() === '') {
                alert('Please fill in all fields.');
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'Dashboard-updateProfile.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    alert(this.responseText);
                    window.location.reload();
                }
            };
            xhr.send('fname=' + encodeURIComponent(fname) + '&lname=' + encodeURIComponent(lname) +
                '&bio=' + encodeURIComponent(bio));
        }


        function CreateLessons() {
            var contentDiv = document.getElementById('createLessonContainer');
            contentDiv.style.display = 'block';
            document.getElementById('editProfileContainer').style.display = 'none';
            document.getElementById('checkLessonContainer').style.display = 'none';
        }

        function createLesson() {
            // Prevent the form from submitting the traditional way
            event.preventDefault();

            var fname = document.getElementById('fname').value;
            var subject = document.getElementById('subject').value;
            var level = document.getElementById('level').value;
            var date = document.getElementById('date').value;
            var price = document.getElementById('price').value;
            var timeSlot = document.getElementById('timeSlot').value;
            var numOfStudent = document.getElementById('numOfStudent').value;

            if (!fname || !subject || !level || !date || !price || !timeSlot || !numOfStudent) {
                alert("All fields must be filled out");
                return false;
            }

            var uuid = "<?php echo isset($_SESSION['uuid']) ? $_SESSION['uuid'] : ''; ?>";

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'teacherDashboard-createLesson.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    alert(this.responseText);
                }
            };
            xhr.send('fname=' + encodeURIComponent(fname) +
                '&subject=' + encodeURIComponent(subject) +
                '&level=' + encodeURIComponent(level) +
                '&timeSlot=' + encodeURIComponent(timeSlot) +
                '&approvel=0' +
                '&uuid=' + encodeURIComponent(uuid) +
                '&price=' + encodeURIComponent(price) +
                '&date=' + encodeURIComponent(date) + 
                '&numOfStudent=' + encodeURIComponent(numOfStudent) );
        }
    </script>
</body>

</html>