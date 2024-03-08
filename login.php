<?php
    include "inc/head.inc.php";
?>

<body>
  <?php include "inc/nav.inc.php"; ?>
    <main class="container">
      <h1>
        Member Registration
      </h1>
      <p>
        For new members, go to here
        <a href="register.php">
          Register Page
        </a>
        .
      </p>

      <form action="process_login.php" method="post">
       
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input required maxlength="45" class="form-control" type="email" id="email" name="email" placeholder="Enter email">
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Password:</label>
            <input required class="form-control" type="password" id="pwd" name="pwd" placeholder="Enter password">
        </div>
       
        <div class="mb-3"> 
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>
