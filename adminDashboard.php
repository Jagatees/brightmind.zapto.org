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
    <title>Bright Minds Academy</title>
    <?php include "inc/head.inc.php"; ?>
</head>
<body>
<div id="main">

    <?php include "inc/header.inc.php"; ?>
    <div id="menu">
        <button onclick="approveLesson()">Approve-Lesson</button>
        <button onclick="createTeacherAccount()">Create-Teacher-Account</button>
        <button onclick="userall()">User-Account</button>
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
            contentDiv.innerHTML = '<h2>Lessons</h2>';
            allLessons.forEach(function(lesson) {
                contentDiv.innerHTML += '<p><strong>ID:</strong> ' + lesson.idlessons + '</p>';
                contentDiv.innerHTML += '<p><strong>Teacher ID:</strong> ' + lesson.idteacher + '</p>';
                contentDiv.innerHTML += '<p><strong>Time Slot:</strong> ' + lesson.time_slot + '</p>';
                contentDiv.innerHTML += '<p><strong>Module:</strong> ' + lesson.module + '</p>';
                contentDiv.innerHTML += '<p><strong>Level:</strong> ' + lesson.level + '</p>';
                contentDiv.innerHTML += '<p><strong>approvel:</strong> ' + lesson.approvel + '</p>';
                contentDiv.innerHTML +=  '<button onclick="updateApproval('+lesson.idlessons+', 1)">Approve</button>';
                contentDiv.innerHTML +=  '<button onclick="updateApproval('+lesson.idlessons+', 0)">Do Not Approve</button>';
                contentDiv.innerHTML += '<hr>'; 
            });
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
            contentDiv.innerHTML += '<button onclick="saveProfileChanges()">Save Changes</button>';
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