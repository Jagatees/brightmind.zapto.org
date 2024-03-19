<?php
session_start();
?>

<div id="mySidenav" class="sidenav">
<a href="index.php">Home</a>
  <a href="ourTeacher.php">Our Teachers</a>
  <a href="lessons.php">Lessons</a>

  <!-- Check if user is logged in -->
  <?php if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']): ?>
    
    <span>UserName, <?php echo htmlspecialchars($_SESSION['fname']); ?></span>
    <span>Role, <?php echo htmlspecialchars($_SESSION['role']); ?></span>

    <a href="adminDashboard.php">Admin-Dashboard</a>
    <a href="studentDashboard.php">Student-Dashboard</a>
    <a href="tutorDashboard.php">Teachers-Dashboard</a>

    <a href="logout.php">Logout</a>
  <?php else: ?>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
  <?php endif; ?>

  
</div>

<span style="font-size:30px;cursor:pointer" onclick="toggleNav()">&#9776;</span>
