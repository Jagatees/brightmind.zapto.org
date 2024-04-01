<header class="jumbotron text-dark custom-bg ">
    <div style="width:30%; text-align:left;">
        <?php include "components/nav-bar/nav.php"; ?>
    </div>
    <div class="header-title" style="padding-top:10px; padding-bottom:10px; width:40%;">
        <img src="images/BMALogo2.png" alt="" height="80px" width="262px">
    </div>
    <div style="width:30%; text-align:right; padding-right:5px;">
        <?php if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']): ?>
            <span style="font-size:15px; cursor:pointer; padding-left:5px; color:#ffffff;" >Welcome Back, <?php echo htmlspecialchars($_SESSION['fname']) . ' ' . htmlspecialchars($_SESSION['lname']) . ' ( Role :' . htmlspecialchars(ucfirst($_SESSION['role'])) . ')'; ?></span>
        <?php else: ?>
            <a href="login.php" style="font-size:15px; cursor:pointer; padding-left:5px; color:#ffffff; text-decoration: none;">Not Logged In</a>
        <?php endif; ?>
    </div>
</header>
