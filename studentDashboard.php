<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bright Minds Academy - Tutor Dashboard</title>
    <!-- Include Bootstrap CSS, existing stylesheets, and additional styles -->
    <?php include "inc/head.inc.php"; // This should include your styles and Bootstrap ?>

    <style>
        #timeslotContainer {
            display: none; /* Initially hide the timeslot container */
            margin-top: 20px;
        }
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
                            <!-- Modified the href to "#" and added an id -->
                            <a class="nav-link" href="#" id="viewClassesLink"> 
                                View Classes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="edit_profile.php">
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
            </main>
        </div>
    </div>
    
    <?php include "inc/footer.inc.php"; // Include footer components ?>
    <!-- jQuery and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function(){
        $("#viewClassesLink").click(function(event){
            event.preventDefault(); // Prevents direct navigation to the link
            
            // HTML content for timeslots
            var timeslotsHtml = `
                <h4>Classes Booked</h4>
                <p>Mr Prik: 23 March 2024 10:00 AM - 11:00 AM</p>
                <p>Mr James: 24 March 2024 11:00 AM - 12:00 PM</p>
                <!-- Add more timeslots as needed -->
            `;
            
            // Populate the timeslot container with timeslot HTML and show it
            $("#timeslotContainer").html(timeslotsHtml).fadeIn();
        });
    });
    </script>

</body>
</html>
