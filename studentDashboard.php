<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bright Minds Academy - Tutor Dashboard</title>
    <?php include "inc/head.inc.php"; // This should include your styles and Bootstrap ?>
    <!-- Include jQuery UI CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        #timeslotContainer, #editProfileContainer, #calendarContainer {
            display: none; /* Initially hide the containers */
            margin-top: 20px;
        }

        /* Custom Calendar Styles */
        .ui-datepicker {
            width: 100%;
            background: #0097a7;
            border: 1px solid #555;
            color: #fff;
        }
        .ui-datepicker-title {
            margin: 10px 0;
        }
        .ui-state-default, .ui-widget-content .ui-state-default {
            background: transparent;
            color: #fff;
        }
        .ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {
            background: #005f6b;
            color: #ffeb3b;
        }
        .ui-datepicker-header {
            color: #fff;
            background-color: #007c91;
        }
        .ui-datepicker-prev, .ui-datepicker-next {
            cursor: pointer;
        }
        /* More custom styles can be added here as needed */
    </style>
</head>
<body>
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
                                <span class="ml-2">John</span>
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
                    <!-- Timeslots will be inserted here -->
                </div>

                <!-- Container for editing profile -->
                <div id="editProfileContainer" class="container">
                    <!-- Edit Profile form will be inserted here -->
                </div>

                <!-- Container for the calendar -->
                <div id="calendarContainer" class="container">
                    <!-- Calendar will be initialized here -->
                </div>
            </main>
        </div>
    </div>
    
    <?php include "inc/footer.inc.php"; // Include footer components ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function(){

        // Initialize the calendar
        $("#calendarContainer").datepicker({
            // Customizations specific to booked dates can be applied here
            beforeShowDay: function(date) {
                // Array of booked dates (could be dynamically generated)
                var bookedDates = ["2024-03-23", "2024-03-24"];
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                if (bookedDates.indexOf(string) >= 0) {
                    return [true, 'ui-state-highlight', 'Booked']; // Highlight booked dates
                }
                return [true, '', ''];
            }
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
                <h4>Edit Profile</h4>
                <form id="editProfileForm">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday:</label>
                        <input type="date" class="form-control" id="birthday">
                    </div>
                    <div class="form-group">
                        <label for="profilePicture">Profile Picture:</label>
                        <input type="file" class="form-control-file" id="profilePicture">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            `;
            // Populate the edit profile container and show it
            $("#editProfileContainer").html(editProfileHtml).fadeIn();
            // Hide the timeslot container to prevent overlapping containers
            $("#timeslotContainer").fadeOut();
            // Hide the timeslot container to prevent overlapping containers
            $("#calendarContainer").fadeOut();
        });
    });
    </script>
</body>
</html>
