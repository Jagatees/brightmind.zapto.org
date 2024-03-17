<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bright Minds Academy - Tutor Dashboard</title>
    <!-- Include Bootstrap CSS, existing stylesheets, and additional styles -->
    <?php include "inc/head.inc.php"; // This should include your styles and Bootstrap ?>
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
                            <a class="nav-link" href="allocate_classes.php"> 
                                Allocate Classes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pending_requests.php">
                                Pending Requests
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
        </div>
    </div>
    <?php include "inc/footer.inc.php"; // Include footer components ?>

</body>
</html>
