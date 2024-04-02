<?php session_start(); ?>
<div id="mySidenav" class="sidenav">
    <a href="home.php">Home</a>
    <a href="aboutUs.php">AboutUs</a>
    <a href="ourTeacher.php">Our Teachers</a>
    <a href="lessons.php">Enroll in Lesson</a>

    <?php if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']): ?>
        <?php if($_SESSION['role'] === 'admin'): ?>
            <a href="adminDashboard.php">Admin Dashboard</a>
        <?php elseif($_SESSION['role'] === 'student'): ?>
            <a href="studentDashboard.php">Student Dashboard</a>
        <?php elseif($_SESSION['role'] === 'teacher'): ?>
            <a href="teacherDashboard.php">Teacher Dashboard</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</div>

<span style="font-size:30px; cursor:pointer; padding-left:5px; color:#ffffff;" onclick="toggleNav()">&#9776;</span>
