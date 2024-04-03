<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<div id="mySidenav" class="sidenav">
    <a href="home.php" class="nav-link">Home</a>
    <a href="aboutUs.php" class="nav-link">About Us</a>
    <a href="ourTeacher.php" class="nav-link">Our Teachers</a>
    <a href="lessons.php" class="nav-link">Enroll in Lesson</a>

    <?php if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']): ?>
        <?php if($_SESSION['role'] === 'admin'): ?>
            <a href="adminDashboard.php" class="nav-link">Admin Dashboard</a>
        <?php elseif($_SESSION['role'] === 'student'): ?>
            <a href="studentDashboard.php" class="nav-link">Student Dashboard</a>
        <?php elseif($_SESSION['role'] === 'teacher'): ?>
            <a href="teacherDashboard.php" class="nav-link">Teacher Dashboard</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php" class="nav-link">Login</a>
        <a href="register.php" class="nav-link">Register</a>
    <?php endif; ?>
</div>

<span style="font-size:30px; cursor:pointer; padding-left:5px; color:#ffffff;" onclick="toggleNav()">&#9776;</span>
