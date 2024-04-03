<?php
session_start();
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true)) {
    header('Location: login.php');
    exit; // Make sure to terminate the script
}

include "database/function.php";

$lessons = getlessons();
$allLessonsJSON = json_encode($lessons, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$user = getAllUsers();
$allUserJSON = json_encode($user, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bright Minds Academy - Admin Dashboard</title>
    <?php include "inc/head.inc.php"; // This should include your styles and Bootstrap ?>
    <!-- Include jQuery UI CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="css/bubble.css" rel="stylesheet">
    <style>
    p {
        color:whitesmoke;
    }
    /* Approving lessons */
    .main-container {
    display: flex;
    justify-content: center;
    align-items: flex-start; /* This will align items to the start of the container */
    padding-top: 20px; /* Add space from the header */
    padding-bottom: 20px; /* Add space from the footer */
    }

    .row {
    margin: 0;
    padding: 0;
    }

    .lesson-card {
    flex: 1 1 calc(50% - 40px); /* Allow cards to grow and shrink but not exceed half the container's width */
    max-width: calc(50% - 40px); /* Max width so two cards fit side by side */
    background: #525abd;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    padding: 20px;
    box-sizing: border-box; /* Include padding in width calculations */
    }

    .approve, .deny {
    display: inline-block;
    padding: 10px 15px;
    margin: 5px;
    border-radius: 5px;
    cursor: pointer;
    border: none;
    }

    .approve {
    background-color: #4CAF50; /* Green */
    color: white;
    }

    .deny {
    background-color: #f44336; /* Red */
    color: white;
    }

    @media (max-width: 768px) {
    .lesson-card {
        flex-basis: calc(100% - 40px); /* On small screens, take full width minus padding */
        max-width: calc(100% - 40px); /* Adjust maximum width for small screens */
    }
    .user-card {
        flex-basis: calc(100% - 40px); /* On small screens, take full width minus padding */
        max-width: calc(100% - 40px); /* Adjust maximum width for small screens */
    }
    }

    .lesson-header {
    width: 100%; /* Ensure the header takes the full width */
    }

    .lessons-title {
    text-align: center;
    color: #000000; 
    padding: 10px 0;
    font-size: 24px;
    width: 100%;
    }   
    .lesson-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start; /* Align to the start of the main content */
    margin-top: 30px;
    margin-bottom: 30px;
    gap: 20px; /* Space between cards */
    align-items: flex-start; /* Align items to the top */
    width: 100%; /* Take up 100% of the main container */
    max-width: calc(100% - 40px); /* Max width accounting for padding */
    }
    main {
    flex-direction: column; /* Stack sidebar and content vertically on smaller screens */
    }

    .lesson-container {
    justify-content: center; /* Center cards within the lesson-container on smaller screens */
    }


    /* Delete Users*/
    .user-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start; /* Align to the start of the main content */
    gap: 20px; /* Space between cards */
    align-items: flex-start; /* Align items to the top */
    width: 100%; /* Take up 100% of the main container */
    max-width: calc(100% - 40px); /* Max width accounting for padding */
    }

    .user-card {
    flex: 1 1 calc(50% - 40px); /* Allow cards to grow and shrink but not exceed half the container's width */
    max-width: calc(50% - 40px); /* Max width so two cards fit side by side */
    background: #525abd;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    padding: 20px;
    box-sizing: border-box; /* Include padding in width calculations */
    }

    /* Create teacher page */
    .create-teacher-form {
    max-width: 500px;
    margin: 2rem auto;
    padding: 2rem;
    background: #525abd;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    gap: 1rem;
    }

    .create-teacher-form h2 {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #FFFFFF;
    }

    .create-teacher-form input,
    .create-teacher-form button {
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-top: 0.5rem;
    }

    .create-teacher-form button {
    background-color: #5c6bc0;
    color: white;
    cursor: pointer;
    border: none;
    }

    .create-teacher-form label {
    font-weight: bold;
    color:#FFFFFF;
    }

    .create-teacher-form input:focus {
    outline: none;
    border-color: #5c6bc0;
    }

    .create-teacher-form button:hover {
    background-color: #3949ab;
    }
    </style>
</head>
<body onload="approveLesson()">
<div id="main">
    <?php include "inc/header.inc.php"; ?>
    <div class="container-fluid" style="min-height: 54vh;">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <span class="nav-link active">
                                <img src="images/account.png" class="rounded-circle" width="100" style="display: block; margin-left: auto; margin-right: auto;">
                                <br>
                                <p class="ml-2" style="text-align: center;"><?php echo $_SESSION['fname']; ?></p>
                            </span>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick=" event.preventDefault(); approveLesson()">
                                Approve Teacher Lessons
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick=" event.preventDefault(); createTeacherAccount()">
                                Create Teacher Account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); userall()">
                                Delete Account
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
                <div id="approveLessonContainer" class="lesson-container">
                    <div id="lessonCardsContainer" class ="lesson-container"></div> 
                </div>

                <div id="createTeacherContainer" class="container">
                
                </div>
                <div id="deleteContainer" class="container user-container">
                </div>
            </main>
        </div>
    </div>
    <?php include "inc/footer.inc.php"; ?>
</div>
    <script>
        // Ensure the PHP-generated JSON strings are not empty
        var allLessonsJSON = '<?php echo $allLessonsJSON; ?>';
        var allUserJSON = '<?php echo $allUserJSON; ?>';

        var allLessons = allLessonsJSON ? JSON.parse(allLessonsJSON) : [];
        var allUser = allUserJSON ? JSON.parse(allUserJSON) : [];
        
        if (allLessonsJSON) {
            var allLessons = JSON.parse(allLessonsJSON);
        } else {
            console.error('allLessonsJSON is empty or invalid');
        }

        if (allUserJSON) {
            var alluser = JSON.parse(allUserJSON);
        } else {
            console.error('allUserJSON is empty or invalid');
        }

        function approveLesson() {
            
            // Hide various containers
            document.getElementById('content').style.display = 'none';
            document.getElementById('createTeacherContainer').style.display = 'none';
            document.getElementById('deleteContainer').style.display = 'none';

            // Clear and display the lesson cards container
            var lessonCardsContainer = document.getElementById('lessonCardsContainer');
            var approveLessonContainer = document.getElementById('approveLessonContainer');
            approveLessonContainer.style.display = 'block'; // Make sure this is visible
            lessonCardsContainer.innerHTML = ''; // Clear previous cards
            approveLessonContainer.innerHTML = '<h2>Approve Lessons</h2><div class="user-container">'; 
            // Loop through all lessons to create approval cards
            allLessons.forEach(function(lesson) {
                // Check for undefined values and print to console if found
                Object.entries(lesson).forEach(([key, value]) => {
                    if (value === undefined) {
                        console.log('Undefined found for key:', key);
                    }
                });
                var cardHtml = '<div class="lesson-card">';
                cardHtml += '<p><strong>ID:</strong> ' + (lesson.lesson_id ) + '</p>';
                cardHtml += '<p><strong>Teacher ID:</strong> ' + (lesson.uuid ) + '</p>';
                cardHtml += '<p><strong>Teacher Name:</strong> ' + (lesson.teacher_name ) + '</p>';
                cardHtml += '<p><strong>Time Slot:</strong> ' + (lesson.time_slot ) + '</p>';
                cardHtml += '<p><strong>Module:</strong> ' + (lesson.module ) + '</p>';
                cardHtml += '<p><strong>Level:</strong> ' + (lesson.level) + '</p>';
                cardHtml += '<p><strong>Approval:</strong> ' + (lesson.approvel) + '</p>';
                cardHtml += '<button class="approve" onclick="updateApproval(\'' + lesson.uuid + '\', 1)">Approve</button>';
                cardHtml += '<button class="deny" onclick="updateApproval(\'' + lesson.uuid + '\', 0)">Do Not Approve</button>';
                cardHtml += '</div>';

                lessonCardsContainer.innerHTML += cardHtml;
            });
            approveLessonContainer.appendChild(lessonCardsContainer); // Add this line
        }




        function updateApproval(uuid, approvalStatus) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'adminDashboard-ApproveLesson.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    location.reload();
                }
            };
            xhr.send('uuid=' + encodeURIComponent(uuid) + '&approvalStatus=' + approvalStatus);
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
            createTeacherDiv.innerHTML += '<input id="email" class="form-content" type="email" name="email" required maxlength="45" placeholder="Enter email" oninput="validateEmailInput(this)"><br>';
            createTeacherDiv.innerHTML += '<label for="password">Password:</label>';
            createTeacherDiv.innerHTML += '<input id="pwd" class="form-content" type="password" name="password" required placeholder="Enter password"><br>';
            createTeacherDiv.innerHTML += '<label for="pwd_confirm">Confirm Password:</label>';
            createTeacherDiv.innerHTML += '<input required class="form-content" type="password" id="pwd_confirm" name="pwd_confirm" placeholder="Confirm password"><br>';
            
            // Add input fields for bio, age, and price
            createTeacherDiv.innerHTML += '<label for="bio">Bio:</label>';
            createTeacherDiv.innerHTML += '<textarea id="bio" class="form-content" name="bio" placeholder="Enter bio"></textarea><br>';
            createTeacherDiv.innerHTML += '<label for="age">Age:</label>';
            createTeacherDiv.innerHTML += '<input type="number" id="age" name="age" class="form-content" placeholder="Enter age"><br>';
            createTeacherDiv.innerHTML += '<label for="price">Price:</label>';
            createTeacherDiv.innerHTML += '<input type="number" id="price" name="price" class="form-content" placeholder="Enter price"><br>';

            // Add radio buttons for subjects
            createTeacherDiv.innerHTML += '<label for="subjects">Subjects:</label><br>';
            createTeacherDiv.innerHTML += '<input type="radio" id="math" name="subject" value="Math">';
            createTeacherDiv.innerHTML += '<label for="math">Math</label><br>';
            createTeacherDiv.innerHTML += '<input type="radio" id="english" name="subject" value="English">';
            createTeacherDiv.innerHTML += '<label for="english">English</label><br>';
            createTeacherDiv.innerHTML += '<input type="radio" id="science" name="subject" value="Science">';
            createTeacherDiv.innerHTML += '<label for="science">Science</label><br>';
            createTeacherDiv.innerHTML += '<input type="radio" id="motherTongue" name="subject" value="MotherTongue">';
            createTeacherDiv.innerHTML += '<label for="motherTongue">Mother Tongue</label><br>';
            
            createTeacherDiv.innerHTML += '<button onclick="createAccount()">Create</button>';

            // Append the card to the contentDiv
            contentDiv.innerHTML = '';
            contentDiv.appendChild(createTeacherDiv);
        }

        function validateEmailInput(inputElement) {
            var popup = document.getElementById('emailPopup');
            if (!inputElement.value.includes('@')) {
                // If there's no popup, create it
                if (!popup) {
                    popup = document.createElement('div');
                    popup.id = 'emailPopup';
                    popup.style.position = 'absolute';
                    popup.style.left = inputElement.offsetLeft + 'px'; // Align left edge with the input
                    popup.style.top = inputElement.offsetTop + inputElement.offsetHeight + 'px'; // Position below the input
                    popup.style.backgroundColor = 'grey';
                    popup.style.border = '1px solid black';
                    popup.style.padding = '5px';
                    popup.style.marginTop = '5px'; // Add a little space between the input and popup
                    popup.style.fontSize = '12px'; // Smaller font size for the popup
                    popup.style.zIndex = '10'; // Ensure the popup is above other elements
                    popup.textContent = "@ is required in the email field.";
                    document.body.appendChild(popup); // Append to the body to avoid positioning issues
                }
                popup.style.display = 'block';
            } else {
                // If the email contains '@', hide the popup
                if (popup) {
                    popup.style.display = 'none';
                }
            }
        }



        function generateUUID() {
          return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
              var r = Math.random() * 16 | 0, v = c === 'x' ? r : (r & 0x3 | 0x8);
              return v.toString(16);
          });
      }

      function createAccount() {
            var fname = document.getElementById('fname').value;
            var lname = document.getElementById('lname').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('pwd').value;
            var uuid = generateUUID();

            // Get the chosen subject
            var selectedSubject = document.querySelector('input[name="subject"]:checked').value;

            // Get values of bio, age, and price
            var bio = document.getElementById('bio').value;
            var age = document.getElementById('age').value;
            var price = document.getElementById('price').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'adminDashboard-createAccount.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    alert('Teacher created successfully'); 
                }
            };
            xhr.send('fname=' + encodeURIComponent(fname) +
                '&lname=' + encodeURIComponent(lname) +
                '&email=' + encodeURIComponent(email) +
                '&password=' + encodeURIComponent(password) +
                '&uuid=' + encodeURIComponent(uuid) +
                '&subject=' + encodeURIComponent(selectedSubject) + // Include the selected subject
                '&bio=' + encodeURIComponent(bio) + // Include the bio
                '&age=' + encodeURIComponent(age) + // Include the age
                '&price=' + encodeURIComponent(price)); // Include the price
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