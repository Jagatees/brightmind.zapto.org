<header class="jumbotron text-dark custom-bg ">
    <?php include "components/nav-bar/nav.php"; ?>
    <div class="header-title" style="padding-top:10px; padding-bottom:10px; padding-right:25px;">
        <img src="images/BMALogo2.png" alt="" height="80px" width="262px">
    </div>
    <?php if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']): ?>
        <span style="font-size:15px; cursor:pointer; padding-left:5px; color:#ffffff;" >Welcome Back, <?php echo htmlspecialchars($_SESSION['uuid']) . ' ' . htmlspecialchars($_SESSION['lname']) . ' ( Role :' . htmlspecialchars(ucfirst($_SESSION['role'])) . ')'; ?></span>
    <?php else: ?>
        <a href="login.php" style="font-size:15px; cursor:pointer; padding-left:5px; color:#ffffff; text-decoration: none;">Not Logged In</a>
    <?php endif; ?>
</header>
