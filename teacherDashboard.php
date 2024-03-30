<?php
session_start();
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true)) {
    header('Location: login.php');
    exit; 
}

include "database/function.php";

if(isset($_SESSION['uuid'])) {
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
    <?php include "inc/head.inc.php"; // This should include your styles and Bootstrap ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="css/teacherDashboards.css" rel="stylesheet">
    <style>
        /* Add your CSS styles here */
        .readonly {
            background-color: #f2f2f2; /* Gray background color */
            color: #666666; /* Gray text color */
            cursor: not-allowed; /* Change cursor to not-allowed */
        }

        /* Additional styles can be added as needed */
    </style>
</head>
<body>
<div id="main">
    <?php include "inc/header.inc.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <span class="nav-link active">
                                <img src="student.jpg" class="rounded-circle" width="50" height="50">
                                <span class="ml-2">NAME</span>
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

            <!-- Main content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div id="content">
                </div>
                <div id="editProfileContainer" class="container">
                    
                </div>

                <div id="createLessonContainer" class="container" style="display: none;">
                    <div class= "create-lesson-form">
                        <div class="row">
                            <h4>Create Lessons</h4>
                            <br><br>
                            <form id="editProfileForm">
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-2 col-form-label">Teacher name</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="fname" name="fname" required value="<?php echo htmlspecialchars($_SESSION['fname']); ?>" >
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

        var allLessonsJSON = '<?php echo $allLessonsJSON; ?>';
        var allLessons = allLessonsJSON ? JSON.parse(allLessonsJSON) : [];

        if (allLessonsJSON) {
            var allLessons = JSON.parse(allLessonsJSON);
        } else {
            console.error('allLessonsJSON is empty or invalid');
        }

        function CheckLessonApprovel() {
            
            // Hide various containers
            document.getElementById('content').style.display = 'none';
            document.getElementById('createLessonContainer').style.display = 'none';
            document.getElementById('editProfileContainer').style.display = 'none';

            // Clear and display the lesson cards container
            var checkLessonContainer = document.getElementById('checkLessonContainer');
            checkLessonContainer.style.display = 'block'; // Ensure container is visible
            checkLessonContainer.innerHTML = ''; // Clear previous content
            // Loop through all lessons to create approval cards
            allLessons.forEach(function(lesson) {
                // Check for undefined values and print to console if found
                Object.entries(lesson).forEach(([key, value]) => {
                    if (value === undefined) {
                        console.log('Undefined found for key:', key);
                    }
                });

                var cardHtml = '<div class= "checklesson-card">';
                cardHtml += '<p><strong>ID:</strong> ' + (lesson.lesson_id ) + '</p>';
                cardHtml += '<p><strong>Teacher ID:</strong> ' + (lesson.uuid ) + '</p>';
                cardHtml += '<p><strong>Teacher Name:</strong> ' + (lesson.teacher_name ) + '</p>';
                cardHtml += '<p><strong>Time Slot:</strong> ' + (lesson.time_slot ) + '</p>';
                cardHtml += '<p><strong>Module:</strong> ' + (lesson.module ) + '</p>';
                cardHtml += '<p><strong>Level:</strong> ' + (lesson.level) + '</p>';
                cardHtml += '<p><strong>Approval:</strong> ' + (lesson.approvel) + '</p>';
                cardHtml += '</div>';

                checkLessonContainer.innerHTML += cardHtml;
            });
        }

        // EDIT PROFILE : START
        function editProfile() {
            var contentDiv = document.getElementById('editProfileContainer');
            contentDiv.innerHTML = ''; // Clear previous content
            contentDiv.style.display = 'block'; // Make sure to display the container
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
                    <button type="submit" class="btn btn-primary" onclick="updateProfile()">Update Profile</button>
                </form>
            </div>
            `;
            contentDiv.innerHTML = formHtml;
        }


        function updateProfile() {
            var fname = document.getElementById('fname').value;
            var lname = document.getElementById('lname').value;
          
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'teacherDashboard-updateProfile.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    alert(this.responseText); 
                }
            };
            xhr.send('fname=' + encodeURIComponent(fname) + '&lname=' + encodeURIComponent(lname));
        }

        // EDIT PROFILE : END


        // // SUBMITLESSONS : START
        // function CreateLessons() {
        //     var contentDiv = document.getElementById('createLessonContainer');
        //     contentDiv.innerHTML = ''; // Clear previous content
        //     contentDiv.style.display = 'block'; // Make sure to display the container
        //     // Hide other sections
        //     document.getElementById('editProfileContainer').style.display = 'none';
        //     document.getElementById('checkLessonContainer').style.display = 'none';
        //     var formHtml = `
        //     <div class= "create-lesson-form">
        //         <h2>Create Lessons</h2>
        //         <form id="editProfileForm">
        //             <div class="form-group">
        //                 <label for="fname">Teacher-Name</label>
        //                 <input type="text" id="fname" name="fname" class="form-control readonly" required value="${userFirstName}" readonly>
        //             </div>
        //             <div class="form-group">
        //                 <label>Subject</label><br>
        //                 <select id="subject" name="subject" class="form-control">
        //                     <option value="Math">Math</option>
        //                     <option value="English">English</option>
        //                     <option value="Science">Science</option>
        //                     <option value="MotherTongue">MotherTongue</option>

        //                 </select>
        //             </div>
        //             <div class="form-group">
        //                 <label>Level</label><br>
        //                 <select id="level" name="level" class="form-control">
        //                     <option value="P1">P1</option>
        //                     <option value="P2">P2</option>
        //                     <option value="P3">P3</option>
        //                     <option value="P4">P4</option>
        //                     <option value="P5">P5</option>
        //                     <option value="P6">P6</option>
        //                 </select>
        //             </div>
        //             <div class="form-group">
        //                 <label for="timeSlot">Time Slot</label>
        //                 <select id="timeSlot" name="timeSlot" class="form-control">
        //                     <option value="1:00pm to 3:00pm">1:00pm to 3:00pm</option>
        //                     <option value="3:00pm to 5:00pm">3:00pm to 5:00pm</option>
        //                 </select>
        //             </div>
        //             <button type="submit" class="btn btn-primary" onclick="createLesson()">Submit Lessons</button>
        //         </form>
        //     </div>
        //     `;
        //     contentDiv.innerHTML = formHtml;
        // }

        function CreateLessons() {
            var contentDiv = document.getElementById('createLessonContainer');
            // contentDiv.innerHTML = ''; // Clear previous content
            contentDiv.style.display = 'block'; // Make sure to display the container
            // Hide other sections
            document.getElementById('editProfileContainer').style.display = 'none';
            document.getElementById('checkLessonContainer').style.display = 'none';
        }

        function createLesson() {
            // Get values from the form fields
            var fname = document.getElementById('fname').value;
            var subject = document.getElementById('subject').value;
            var level = document.getElementById('level').value;
            var date = document.getElementById('date').value;
            var all_time_slot = document.getElementById('timeSlot').value;

            const time_slot_array = all_time_slot.split("|");

            // Get UUID from the session
            var uuid = "<?php echo isset($_SESSION['uuid']) ? $_SESSION['uuid'] : ''; ?>";
            
            for (let i = 0; i < time_slot_array.length; i++) {
                if (time_slot_array[i] !== '')
                {
                    // Make an AJAX request to submit the lesson data
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'teacherDashboard-createLesson.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    // xhr.onload = function() {
                    //     if (this.status == 200) {
                    //         alert(this.responseText); // Display response from the server
                    //     }
                    // };
                    // Encode and send the data to the server, including approvel and UUID
                    xhr.send('fname=' + encodeURIComponent(fname) 
                    + '&subject=' + encodeURIComponent(subject) 
                    + '&level=' + encodeURIComponent(level) 
                    + '&timeSlot=' + encodeURIComponent(time_slot_array[i])
                    + '&approvel=0'
                    + '&uuid=' + encodeURIComponent(uuid)
                    + '&date=' + encodeURIComponent(date));
                    console.log(date);
                }
            }

        }
        // SUBMITLESSONS : END

        // ApproveLesson : START

        
        // ApproveLesson : END
    </script>
</body>
</html>