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
        .user-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start; /* Align to the start of the main content */
        gap: 20px; /* Space between cards */
        align-items: flex-start; /* Align items to the top */
        width: 100%; /* Take up 100% of the main container */
        max-width: calc(100% - 40px); /* Max width accounting for padding */
        }
        .checklesson-card {
            flex: 1 1 auto; /* Allows the card to grow and shrink as needed */
            background: #525abd;
            padding: 20px;
            margin-right: -1px; /* Overlap cards slightly */
            margin-bottom: -1px; /* Overlap cards slightly */
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            box-sizing: border-box;
            min-width: calc(50% - 20px); /* Minimum width for two cards side-by-side */
        }

        .checklesson-container {
            display: flex;
            flex-wrap: wrap; /* This allows the cards to wrap onto the next line */
            justify-content: flex-start; /* Aligns cards to the start */
            align-items: flex-start; /* Aligns cards to the top */
            gap: 10; 
            margin-bottom: 20px;
        }
        .checklesson-title {
            width: 100%;
            text-align: center;
            margin-top: 100px; /* Adjust this value to push the title down below the header */
            margin-left: 100px;
        }
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between; 
            align-items: flex-start; 
            gap: 20px; 
        }
            /* Create Lesson */
            /* This is to ensure that the main container centers its children */
            .createlesson-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            }

            /* This is the style for the card itself */
            .createlesson-card {
            width: 100%; /* Set width to 100% of the container */
            max-width: 600px; /* Max width to restrict its growth */
            background: #525abd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            padding: 20px; /* Padding inside the card */
            margin: 0 auto; /* Margin auto for left and right to center the card */
            box-sizing: border-box;
            }

            /* Style for the title of the card */
            .createlesson-title {
            color: #000; /* Title color */
            text-align: center; /* Align text to center */
            width: 100%;
            margin-bottom: 20px;
            }



        /* Edit Profile */
        .edit-prof-form {
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
        
        .edit-prof-form h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #FFFFFF;
        }
        
        .edit-prof-form input,
        .edit-prof-form button {
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 0.5rem;
        }
        
        .edit-prof-form button {
            background-color: #5c6bc0;
            color: white;
            cursor: pointer;
            border: none;
        }
        
        .edit-prof-form label {
            font-weight: bold;
        }
        
        .edit-prof-form input:focus {
            outline: none;
            border-color: #5c6bc0;
        }
        
        .edit-prof-form button:hover {
            background-color: #3949ab;
        } 

    </style>
</head>

<body>
    <div id="main">
        <?php include "inc/header.inc.php"; ?>
        <div class="container-fluid" style="min-height: 54vh;">
            <div class="row">
                <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick=" event.preventDefault(); mainContent()">
                                    <img src="images/account.png" class="rounded-circle" width="100" style="display: block; margin-left: auto; margin-right: auto;">
                                    <br>
                                    <p class="ml-2" style="text-align: center;"><?php echo $_SESSION['fname']; ?></p>
                                </a>
                            </li>
                            <hr>
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
                    <br>
                    <div id="content" mainContent()>                        
                    </div>
                    <div id="editProfileContainer" class="container">

                    </div>

                    <div id="createLessonContainer" class="container" style="display: none;">
                        <!-- <div class="createlesson-card"> -->
                            <br>
                            <div class="row">
                                <div class="col-sm-4 offset-md-1">
                                    <h4>Create Lessons</h4>
                                </div>
                                <br><br>
                                <form>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 offset-md-1 col-form-label">Teacher name</label>
                                        <div class="col-sm-7">
                                            <input type="text" readonly class="form-control-plaintext" id="fname" name="fname" required value="<?php echo htmlspecialchars($_SESSION['fname']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="date" class="col-sm-3 offset-md-1 col-form-label">Date</label>
                                        <div class="col-sm-7">
                                            <input type="date" class="form-control" id="date" name="date" min="<?php echo date("Y/m/d"); ?>" required placeholder="Date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="timeSlot" class="col-sm-3 offset-md-1 col-form-label">Time slots</label>
                                        <div class="col-sm-7">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <a href="#" id="8:00am - 10:00am" class="btn btn-light">8:00am - 10:00am</a>
                                                </div>
                                                <div class="col-sm-4">
                                                    <a href="#" class="btn btn-light">10:00am - 12:00pm</a>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <a href="#" class="btn btn-light">12:00pm - 2:00pm</a>
                                                </div>
                                                <div class="col-sm-4">
                                                    <a href="#" class="btn btn-light">2:00pm - 4:00pm</a>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <a href="#" class="btn btn-light">4:00pm - 6:00pm</a>
                                                </div>
                                                <div class="col-sm-4">
                                                    <a href="#" class="btn btn-light">6:00pm - 8:00pm</a>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <a href="#" class="btn btn-light">8:00pm - 10:00pm</a>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <input type="text" id="timeSlot" value="" name="timeSlot" hidden>
                                    </div>
                                    <div class="form-group row">
                                        <label for="subject" class="col-sm-3 offset-md-1 col-form-label">Subject</label>
                                        <div class="col-sm-7">
                                            <select id="subject" name="subject" class="form-select" aria-label="Subject">
                                                <option value="Math" selected>Math</option>
                                                <option value="English">English</option>
                                                <option value="Science">Science</option>
                                                <option value="MotherTongue">Mother Tongue</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="level" class="col-sm-3 offset-md-1 col-form-label">Level</label>
                                        <div class="col-sm-7">
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
                                        <label for="price" class="col-sm-3 offset-md-1 col-form-label">Price</label>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control-plaintext" readonly value="$">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" id="price" name="price" required placeholder="60">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="numOfStudent" class="col-sm-3 offset-md-1 col-form-label">Number of Students</label>
                                        <div class="col-sm-7">
                                            <input type="number" class="form-control" id="numOfStudent" name="numOfStudent" required placeholder="e.g., 10" min="1" max="10">
                                        </div>
                                    </div>
                                    <div class="col-md-3 offset-md-8">
                                    <button type="submit" class="btn btn-primary" onclick="createLesson()" style="float:right;">Create</button>
                                    <br>
                                    <br>
                                    </div>
                                </form>
                            </div>
                        <!-- </div> -->
                    </div>
                    <div id="checkLessonContainer" class="checklesson-container">
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
            document.getElementById('content').style.display = 'none';

            var checkLessonContainer = document.getElementById('checkLessonContainer');
            checkLessonContainer.style.display = 'block';

            // Clear any previous content except the title
            checkLessonContainer.innerHTML = '<h2 class="checklesson-title">Check Lesson Approvals</h2>';

            // Create and append the container that will hold the cards
            var cardsContainer = document.createElement('div');
            cardsContainer.className = 'cards-container'; // Ensure this class has the desired styles in CSS
            checkLessonContainer.appendChild(cardsContainer);

            allLessons.forEach(function(lesson) {
                Object.entries(lesson).forEach(([key, value]) => {
                    if (value === undefined) {
                        console.log('Undefined found for key:', key);
                    }
                });

                // Create a new div element for each card
                var cardDiv = document.createElement('div');
                cardDiv.className = 'checklesson-card';
                cardDiv.innerHTML = `
                    <p style="color: #FFFFFF;"><strong style="color: #FFFFFF;">ID:</strong> ${lesson.lesson_id}</p>
                    <p style="color: #FFFFFF;"><strong style="color: #FFFFFF;">Teacher ID:</strong> ${lesson.uuid}</p>
                    <p style="color: #FFFFFF;"><strong style="color: #FFFFFF;">Teacher Name:</strong> ${lesson.teacher_name}</p>
                    <p style="color: #FFFFFF;"><strong style="color: #FFFFFF;">Time Slot:</strong> ${lesson.time_slot}</p>
                    <p style="color: #FFFFFF;"><strong style="color: #FFFFFF;">Module:</strong> ${lesson.module}</p>
                    <p style="color: #FFFFFF;"><strong style="color: #FFFFFF;">Level:</strong> ${lesson.level}</p>
                    <p style="color: #FFFFFF;"><strong style="color: #FFFFFF;">Approval:</strong> ${lesson.approvel}</p>
                `; // Use template literals for better readability
                
                cardsContainer.appendChild(cardDiv); // Append the card to the cards container
            });
            }


        // EDIT PROFILE : START
        function editProfile() {
            var contentDiv = document.getElementById('editProfileContainer');
            contentDiv.innerHTML = '';
            contentDiv.style.display = 'block';
            document.getElementById('createLessonContainer').style.display = 'none';
            document.getElementById('checkLessonContainer').style.display = 'none';
            document.getElementById('content').style.display = 'none';
            var formHtml = `
            <div class= "edit-prof-form">
                <h2>Edit Profile</h2>
                <form id="editProfileForm">
                    <div class="form-group">
                        <label for="fname" style="color: #FFFFFF;">First Name</label>
                        <input type="text" id="fname" name="fname" class="form-control" required value="${userFirstName}">
                    </div>
                    <div class="form-group">
                        <label for="lname" style="color: #FFFFFF;">Last Name</label>
                        <input type="text" id="lname" name="lname" class="form-control" required value="${userLastName}">
                    </div>
                    <div class="form-group">
                        <label for="bio" style="color: #FFFFFF;">Bio</label>
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

        function mainContent() {
            var contentDiv = document.getElementById('content');
            contentDiv.style.display = 'block';
            document.getElementById('editProfileContainer').style.display = 'none';
            document.getElementById('checkLessonContainer').style.display = 'none';
            document.getElementById('createLessonContainer').style.display = 'none';

            var tableContainer = document.createElement('table');
            tableContainer.className = 'table table-hover'; 
            contentDiv.appendChild(tableContainer);

            var tableHead = document.createElement('thead');
            tableHead.innerHTML = `
                <thead>
                    <tr>
                    <th scope="col">Lesson ID</th>
                    <th scope="col">Level</th>
                    <th scope="col">Module</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time Slot</th>
                    <th></th>
                    </tr>
                </thead>
            `;

            tableContainer.appendChild(tableHead);


            var tableBody = document.createElement('tbody');
            tableContainer.appendChild(tableBody);

            allLessons.forEach(function(lesson) {
                Object.entries(lesson).forEach(([key, value]) => {
                    if (value === undefined) {
                        console.log('Undefined found for key:', key);
                    }
                });

                // Create a new div element for each card
                var tableRow = document.createElement('tr');
                tableRow.innerHTML = ` 
                    <td>${lesson.lesson_id}</td>
                    <td>${lesson.level}</td>
                    <td>${lesson.module}</td>
                    <td>${lesson.date}</td>
                    `;
                
                const time_slot_array = lesson.time_slot.split("|");
                for (let i = 0; i < time_slot_array.length; i++) {
                    if (time_slot_array[i] != '') {
                        tableRow.innerHTML += `
                            <li class="list-group-item">${time_slot_array[i]}</li>
                            `;
                    }
                }

                tableRow.innerHTML += `

                    <td><a href="#">attendance</a></td>
                `;
                
                tableBody.appendChild(tableRow); // Append the card to the cards container
            });
        }

        function CreateLessons() {
            var contentDiv = document.getElementById('createLessonContainer');
            contentDiv.style.display = 'block';
            document.getElementById('editProfileContainer').style.display = 'none';
            document.getElementById('checkLessonContainer').style.display = 'none';
            document.getElementById('content').style.display = 'none';
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