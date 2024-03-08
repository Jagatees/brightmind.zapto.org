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
        For existing members, please go to the
        <a href="login.php">
          Sign In page
        </a>
        .
      </p>

      <form action="process_register.php" method="post">
        <div class="mb-3">
            <label for="fname" class="form-label">First Name:</label>
            <input maxlength="45" class="form-control" type="text" id="fname" name="fname" placeholder="Enter first name" >
        </div>

        <div class="mb-3">
            <label for="lname" class="form-label">Last Name:</label>
            <input required maxlength="45" class="form-control" type="text" id="lname" name="lname" placeholder="Enter last name">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input required maxlength="45" class="form-control" type="email" id="email" name="email" placeholder="Enter email">
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Password:</label>
            <input required class="form-control" type="password" id="pwd" name="pwd" placeholder="Enter password">
        </div>

        <div class="mb-3">   
            <label for="pwd_confirm" class="form-label">Confirm Password:</label>
            <input required class="form-control" type="password" id="pwd_confirm" name="pwd_confirm" placeholder="Confirm password">
        </div>

        <div class="mb-3 form-check">      
            <input type="checkbox" name="agree" class="form-check-input">
            <label class="form-label" for="agree">Agree to terms and conditions.</label>
        </div>
        <div class="mb-3"> 
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>