<?php
    include "inc/head.inc.php";
?>

<body>
  <?php include "inc/nav.inc.php"; ?>
    <main class="loginbody">
      <div class="logincard">
        <h3>Student Login</h3>
        <p>New? Sign up <a href=register.php>here</a>!</p>

        <form action="process_login.php" method="post">
            <div class="mb-3">
                <label for="email" class="loginlabel">Email:</label>
                <input required maxlength="45" class="form-control" type="email" id="email" name="email" placeholder="Enter email">
            </div>

            <div class="mb-3">
                <label for="pwd" class="loginlabel">Password:</label>
                <input required class="form-control" type="password" id="pwd" name="pwd" placeholder="Enter password">
            </div>
          
            <div class="mb-3"> 
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>
