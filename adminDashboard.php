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
                                <span class="ml-2">Javier</span>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick=" event.preventDefault(); approveLesson()">
                                Approve Lessons
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick=" event.preventDefault(); createTeacherAccount()">
                                Create Teacher Account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); userall()">
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
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div id="content"> <!-- This is where your dynamic content will be loaded -->
                    <!-- This container will initially be empty and will be filled with content by your JavaScript functions -->
                </div>
                <div id="approveLessonContainer" class="lesson-container">
                    <div id="lessonCardsContainer" class ="lesson-container"></div> 
                </div>

                <div id="createTeacherContainer" class="container">
                
                </div>
                <div id="deleteContainer" class="container user-container">
                    <!-- Delete user will be initialized here -->
                </div>
            </main>
        </div>
    </div>
    <?php include "inc/footer.inc.php"; ?>
    <script>
        // Approve Lessons
        var allLessons = JSON.parse('<?php echo $allLessonsJSON; ?>');

        function approveLesson() {
        document.getElementById('content').style.display = 'none'; // Hide the generic content container
        document.getElementById('createTeacherContainer').style.display = 'none'; // Hide create teacher form
        document.getElementById('deleteContainer').style.display = 'none'; // Hide delete user form
        var lessonCardsContainer = document.getElementById('lessonCardsContainer');
        lessonCardsContainer.innerHTML = '';    
        var approveLessonContainer = document.getElementById('approveLessonContainer');
        approveLessonContainer.style.display = 'block'; // Show the approve lesson container


    
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

        lessonCardsContainer.innerHTML += cardHtml;
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
            document.getElementById('content').style.display = 'block';
            document.getElementById('approveLessonContainer').style.display = 'none';
            document.getElementById('deleteContainer').style.display = 'none';

            var contentDiv = document.getElementById('content');
            contentDiv.innerHTML = ''; // Clear the content container
            
            // Create the card container
            var createTeacherDiv = document.createElement('div');
            createTeacherDiv.className = 'create-teacher-form';

            createTeacherDiv.innerHTML += '<h2>Create Teacher Account</h2>';
            createTeacherDiv.innerHTML += '<label for="fname">First Name:</label>';
            createTeacherDiv.innerHTML += '<input maxlength="45" class="form-content" type="text" id="fname" name="fname" placeholder="Enter first name"><br>';
            createTeacherDiv.innerHTML += '<label for="lname">Last Name:</label>';
            createTeacherDiv.innerHTML += '<input required maxlength="45" class="form-content" type="text" id="lname" name="lname" placeholder="Enter last name"><br>';
            createTeacherDiv.innerHTML += '<label for="email">Email:</label>';
            createTeacherDiv.innerHTML += '<input id="email" class="form-content" type="email" name="email" required maxlength="45" placeholder="Enter email"><br>';
            createTeacherDiv.innerHTML += '<label for="password">Password:</label>';
            createTeacherDiv.innerHTML += '<input id="pwd" class="form-content" type="password" name="password" required placeholder="Enter password"><br>';
            createTeacherDiv.innerHTML += '<label for="pwd_confirm">Confirm Password:</label>';
            createTeacherDiv.innerHTML += '<input required class="form-content" type="password" id="pwd_confirm" name="pwd_confirm" placeholder="Confirm password"><br>';
            createTeacherDiv.innerHTML += '<button onclick="createAccount()">Save Changes</button>';

            // Append the card to the contentDiv
            contentDiv.innerHTML = '';
            contentDiv.appendChild(createTeacherDiv);
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
    // Hide other containers
    document.getElementById('approveLessonContainer').style.display = 'none';
    document.getElementById('createTeacherContainer').style.display = 'none';
    document.getElementById('content').style.display = 'none';

    // Now show the deleteContainer and insert user cards
    var deleteContainer = document.getElementById('deleteContainer');
    deleteContainer.style.display = 'block'; // Show the delete user container
    deleteContainer.innerHTML = '<h2>Delete User</h2><div class="user-container">'; // Use user-container for flex styling

    // Create a container for user cards if it doesn't exist
    var userCardsContainer = deleteContainer.querySelector('.user-container');
    if (!userCardsContainer) {
        userCardsContainer = document.createElement('div');
        userCardsContainer.className = 'user-container';
        deleteContainer.appendChild(userCardsContainer);
    }    
    userCardsContainer.innerHTML = ''; // Clear existing cards

    alluser.forEach(function(user) {
        var userCard = document.createElement('div');
        userCard.className = 'user-card';
        userCard.innerHTML = '<p><strong>First Name:</strong> ' + user.fname + '</p>';
        userCard.innerHTML += '<p><strong>Last Name:</strong> ' + user.lname + '</p>';
        userCard.innerHTML += '<p><strong>Subject:</strong> ' + user.subject + '</p>';
        userCard.innerHTML += '<button onclick="deleteUser(\'' + user.fname.replace(/'/g, "\\'") + '\',\'' + user.lname.replace(/'/g, "\\'") + '\',\'' + user.subject.replace(/'/g, "\\'") + '\')">Delete</button>';
        userCard.innerHTML += '<hr>';
        
        userCardsContainer.appendChild(userCard); // Append new cards
    });
    deleteContainer.appendChild(userCardsContainer);
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