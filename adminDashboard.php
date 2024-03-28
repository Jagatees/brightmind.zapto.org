<?php
session_start();
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true)) {
    header('Location: login.php');
    exit; // Make sure to terminate the script
}

include "database/function.php";
$lessons = getlessons();
$allLessonsJSON = json_encode($lessons);

$user = getAllUsers();
$allUserJSON = json_encode($user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bright Minds Academy - Tutor Dashboard</title>
    <?php include "inc/head.inc.php"; // This should include your styles and Bootstrap ?>
    <!-- Include jQuery UI CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="css/bubble.css" rel="stylesheet">

    
    <!-- Custom styles for this template -->
</head>
<body>
<div id="main">

    <?php include "inc/header.inc.php"; ?>
    <div id="menu">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <span class="nav-link active">
                                <img src="student.jpg" class="rounded-circle" width="50" height="50">
                                <span class="ml-2">Javier</span>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="approveLesson()">
                                Approve Lessons
                            </a>
                        </li>
                        <li class="nav-item">
                            <!-- Link for editing profile -->
                            <a class="nav-link" href="#" onclick="createTeacherAccount()">
                                Create Teacher Account
                            </a>
                        </li>
                        <li class="nav-item">
                            
                            <a class="nav-link" href="#" onclick="userall()">
                                Delete User
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
            <div class="col-md-9 ml-sm-auto col-lg-10 px-md-4 d-flex justify-content-center align-items-center">
            <div class="row justify-content-center">
            <div class="col-12 col-md-8">
            <div id="approveLessonContainer" class="container lesson-container">
                <div id="approveLessonContainer" class="container">
                    <!-- Approve Lesson will be inserted here -->
                </div>

                <!-- Container for editing profile -->
                <div id="createTeacherContainer" class="container">
                    <!-- Create Teacher form will be inserted here -->
                </div>

                <!-- Container for the calendar -->
                <div id="deleteContainer" class="container">
                    <!-- Delete user will be initialized here -->
                </div>
            </main>
    </div>
    <div id="content">
       
    </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
    <script>

        // Approve Lessons
        var allLessons = JSON.parse('<?php echo $allLessonsJSON; ?>');

        function approveLesson() {
        var contentDiv = document.getElementById('content');
        contentDiv.innerHTML = '<h2>Lessons</h2><div class="lessons-container">';
    
        allLessons.forEach(function(lesson) {
        var cardHtml = '<div class="lesson-card">';
        cardHtml += '<p><strong>ID:</strong> ' + lesson.idlessons + '</p>';
        cardHtml += '<p><strong>Teacher ID:</strong> ' + lesson.idteacher + '</p>';
        cardHtml += '<p><strong>Time Slot:</strong> ' + lesson.time_slot + '</p>';
        cardHtml += '<p><strong>Module:</strong> ' + lesson.module + '</p>';
        cardHtml += '<p><strong>Level:</strong> ' + lesson.level + '</p>';
        cardHtml += '<p><strong>Approve:</strong> ' + lesson.approvel + '</p>';
        cardHtml += '<button class="approve" onclick="updateApproval('+lesson.idlessons+', 1)">Approve</button>';
        cardHtml += '<button class="deny" onclick="updateApproval('+lesson.idlessons+', 0)">Do Not Approve</button>';
        cardHtml += '</div>';
        contentDiv.innerHTML += cardHtml;
    });
    
    contentDiv.innerHTML += '</div>';
}


        function updateApproval(lessonId, approvalStatus) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'adminDashboard-ApproveLesson.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    location.reload()
                }
            };
            xhr.send('lessonId=' + lessonId + '&approvalStatus=' + approvalStatus);
        }


        // Create Teacher Account
        function createTeacherAccount() {
            var contentDiv = document.getElementById('content');
            contentDiv.innerHTML = '<h2>Edit Profile</h2>';
            contentDiv.innerHTML += '<label for="fname" style="padding-top:13px">&nbsp;First Name:</label>';
            contentDiv.innerHTML += '<input maxlength="45" class="form-content" type="text" id="fname" name="fname" placeholder="Enter first name"><br>';
            contentDiv.innerHTML += '<div class="form-border"></div>';
            contentDiv.innerHTML += '<label for="lname" style="padding-top:22px">&nbsp;Last Name:</label>';
            contentDiv.innerHTML += '<input required maxlength="45" class="form-content" type="text" id="lname" name="lname" placeholder="Enter last name"><br>';
            contentDiv.innerHTML += '<div class="form-border"></div>';
            contentDiv.innerHTML += '<label for="email" style="padding-top:22px">&nbsp;Email:</label>';
            contentDiv.innerHTML += '<input id="email" class="form-content" type="email" name="email" autocomplete="on" required maxlength="45" placeholder="Enter email"><br>';
            contentDiv.innerHTML += '<label for="password" style="padding-top:22px">&nbsp;Password:</label>';
            contentDiv.innerHTML += '<input id="pwd" class="form-content" type="password" name="password" required placeholder="Enter password"><br>';
            contentDiv.innerHTML += '<div class="form-border"></div>';
            contentDiv.innerHTML += '<label for="pwd_confirm" style="padding-top:22px">&nbsp;Confirm Password:</label>';
            contentDiv.innerHTML += '<input required class="form-content" type="password" id="pwd_confirm" name="pwd_confirm" placeholder="Confirm password"><br>';
            contentDiv.innerHTML += '<div class="form-border"></div>';
            contentDiv.innerHTML += '<button onclick="createAccount()">Save Changes</button>';
        }


        function createAccount() {
            var fname = document.getElementById('fname').value;
            var lname = document.getElementById('lname').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('pwd').value;
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'adminDashboard-createAccount.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    alert(this.responseText); 
                }
            };
            xhr.send('fname=' + encodeURIComponent(fname) + '&lname=' + encodeURIComponent(lname) + '&email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password));
        }










        // Display user & then delete
        var alluser = JSON.parse('<?php echo $allUserJSON; ?>');

        function userall() {
            var contentDiv = document.getElementById('content');
            contentDiv.innerHTML = '<h2>Delete User</h2>';
            alluser.forEach(function(user) {
                contentDiv.innerHTML += '<p><strong>fame:</strong> ' + user.fname + '</p>';
                contentDiv.innerHTML += '<p><strong>lname:</strong> ' + user.lname + '</p>';
                contentDiv.innerHTML += '<p><strong>subject:</strong> ' + user.subject + '</p>';
                // Update this line to correctly call deleteUser with the user's details
                contentDiv.innerHTML += '<button onclick="deleteUser(\'' + user.fname.replace(/'/g, "\\'") + '\',\'' + user.lname.replace(/'/g, "\\'") + '\',\'' + user.subject.replace(/'/g, "\\'") + '\')">Delete</button>';
                contentDiv.innerHTML += '<hr>'; 
            });
        }

        function deleteUser(fname, lname, subject) {
            if (!confirm('Are you sure you want to delete this user?')) {
                return; // Stop if the user cancels the action
            }
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'adminDashboard-deleteUser.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    alert(this.responseText); // Alert the result from the server
                    location.reload(); // Reload the page to reflect the changes
                }
            };
            xhr.send('fname=' + encodeURIComponent(fname) + '&lname=' + encodeURIComponent(lname) + '&subject=' + encodeURIComponent(subject));
        }
       
    </script>
</body>
</html>