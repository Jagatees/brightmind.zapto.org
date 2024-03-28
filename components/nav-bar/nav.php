<?php
session_start();
?>

<div id="mySidenav" class="sidenav">
    <a href="home.php">Home</a>
    <a href="ourTeacher.php">Our Teachers</a>
    <a href="lessons.php">Lessons</a>

    <?php if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']): ?>
        <span>Welcome Back, <?php echo htmlspecialchars($_SESSION['uuid']); ?></span>
        <?php if($_SESSION['role'] === 'admin'): ?>
            <a href="adminDashboard.php">Admin Dashboard</a>
            <a href="studentDashboard.php">Student Dashboard</a>
            <a href="teacherDashboard.php">Teacher Dashboard</a>
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

<span style="font-size:30px;cursor:pointer" onclick="toggleNav()">&#9776;</span>
