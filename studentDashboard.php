<?php
session_start();
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'])) {
    header('Location: login.php');
    exit;
}

include "database/function.php";

if (isset($_SESSION['uuid'])) {
    $uuid = $_SESSION['uuid'];
    $lessons = getBookingByUUID($uuid);
    $allbookingJSON = json_encode($lessons, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
} else {
    echo "UUID not found in session.";
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bright Minds Academy - Student Dashboard</title>
    <?php include "inc/head.inc.php"; // This should include your styles and Bootstrap ?>
    <!-- Include jQuery UI CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="css/studentDashboards.css" rel="stylesheet">
    <style>
        #timeslotContainer, #editProfileContainer, #calendarContainer {
            display: none; /* Initially hide the containers */
            margin-top: 20px;
        }

        /* Custom Calendar Styles */
        .ui-datepicker {
            width: 100%;
            background: #eaeb9e; /* Changed to yellow background */
            border: 1px solid #555;
            color: #333; /* Changed to a darker text color for readability */
        }

        .ui-datepicker-title {
            margin: 10px 0;
            color: #333; /* Ensure the title is readable on a light background */
        }

        .ui-state-default, .ui-widget-content .ui-state-default {
            background: transparent;
            color: #333; /* Changed to a darker text color for readability */
        }

        .ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {
            background: #ffc107; /* Changed to a highlighted yellow for selection */
            color: #212121; /* Changed to a darker text color for readability */
        }

        .ui-datepicker-header {
            color: #212121; /* Changed to a darker text color for readability */
            background-color: #fdd835; /* Changed to a darker yellow */
        }

        .ui-datepicker-prev, .ui-datepicker-next {
            cursor: pointer;
            color: #212121; /* Changed to a darker text color for readability */
        }

        /* If you have hover styles, you might want to update those as well */
        .ui-state-default:hover, .ui-widget-content .ui-state-default:hover {
            background: #ffee58; /* Lighter yellow for hover */
        }

        /* Current day or selected day styling */
        .ui-datepicker-today .ui-state-default {
            background: #fbc02d; /* A different shade of yellow for the current day */
            color: #212121; /* Changed to a darker text color for readability */
        }
        /* More custom styles can be added here as needed */
    </style>
</head>
<body>
<div id="main">
    <?php include "inc/header.inc.php"; // Include the header ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
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
                            <a class="nav-link" href="#" id="viewClassesLink">
                                View Classes
                            </a>
                        </li>
                        <li class="nav-item">
                            <!-- Link for editing profile -->
                            <a class="nav-link" href="#" id="editProfileLink">
                                Edit Profile
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
                <div id="timeslotContainer" class="container">
                </div>

                <div id="editProfileContainer" class="container">
                </div>

                <div id="calendarContainer" class="container">
                </div>
            </main>
        </div>
    </div>
    <?php include "inc/footer.inc.php"; ?>
    <div class="modal fade" id="timeslotModal" tabindex="-1" role="dialog" aria-labelledby="timeslotModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="timeslotModalLabel">Booked Timeslots</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        var userFirstName = <?php echo isset($_SESSION['fname']) ? json_encode($_SESSION['fname']) : json_encode(""); ?>;
        var userLastName = <?php echo isset($_SESSION['lname']) ? json_encode($_SESSION['lname']) : json_encode(""); ?>;
        var bio = <?php echo isset($_SESSION['bio']) ? json_encode($_SESSION['bio']) : json_encode(""); ?>;


        var allbookingJSON = '<?php echo $allbookingJSON; ?>';
        var allbookings = allbookingJSON ? JSON.parse(allbookingJSON) : {};


        console.log(allbookings);
        console.log(allbookings[0]['lesson_date']);
        var bookedLessons = {};




    $(document).ready(function(){
        var bookedLessons = {}; // Initialize bookedLessons as an empty object

       // Loop through all bookings
        for (var i = 0; i < allbookings.length; i++) {
            var date = allbookings[i]['lesson_date'];
            var module = allbookings[i]['lesson_module'];
            var time = allbookings[i]['lesson_time'];

            // Check if the date key already exists in bookedLessons
            if (!bookedLessons[date]) {
                bookedLessons[date] = [];
            }

            // Push a new lesson object onto the array for the given date
            bookedLessons[date].push({
                "time": time,   // Time of the lesson
                "subject": module // Subject of the lesson
            });
        }
    

        console.log(bookedLessons);


        $("#calendarContainer").datepicker({
            beforeShowDay: function(date) {
                var dateString = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [bookedLessons.hasOwnProperty(dateString), bookedLessons.hasOwnProperty(dateString) ? 'ui-state-highlight' : '', ''];
            },
            onSelect: function(dateText) {
                var formattedDate = $.datepicker.formatDate('yy-mm-dd', new Date(dateText));
                if (bookedLessons[formattedDate]) {
                    var detailsHtml = bookedLessons[formattedDate].map(function(lesson) {
                        return "<p>" + lesson.time + " - " + lesson.subject + "</p>";
                    }).join('');
                    $('#timeslotModal .modal-body').html(detailsHtml);
                    $('#timeslotModalLabel').text('Booked Lessons for ' + formattedDate);
                    $('#timeslotModal').modal('show');
                }
            }
        });
        // Explicitly handle the modal close functionality
        $('#timeslotModal').on('click', '.close, .btn-secondary[data-dismiss="modal"]', function() {
            $('#timeslotModal').modal('hide');
        });
    });


        $("#viewClassesLink").click(function(event){
            event.preventDefault(); // Prevents direct navigation to the link

            // Show the calendar container instead of timeslot HTML
            $("#calendarContainer").fadeIn();
            $("#timeslotContainer").fadeOut();
            $("#editProfileContainer").fadeOut();
        });

        $("#editProfileLink").click(function(event){
            event.preventDefault(); // Prevents direct navigation
            var editProfileHtml = `
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
            // Populate the edit profile container and show it
            $("#editProfileContainer").html(editProfileHtml).fadeIn();
            // Hide the timeslot container to prevent overlapping containers
            $("#timeslotContainer").fadeOut();
            // Hide the timeslot container to prevent overlapping containers
            $("#calendarContainer").fadeOut();
        });


        function updateProfile() {
            var fname = document.getElementById('fname').value;
            var lname = document.getElementById('lname').value;
            var bio = document.getElementById('bio').value;

            
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
    </script>
</body>
</html>
