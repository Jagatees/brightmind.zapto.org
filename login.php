<!DOCTYPE html>
<html lang="en">

<?php session_start(); ?>
<head>
  <?php
      include "inc/head.inc.php";
  ?>
  <style>
    a {
      text-decoration: none;
    }
    h2 {
      text-decoration: none;
    }
    body {
      background: -webkit-linear-gradient(bottom, #87CEEB, #dbe9f4);
      background-repeat: no-repeat;
    }
    label {
      font-family: "Raleway", sans-serif;
      font-size: 11pt;
    }
    #card {
      background: #fbfbfb;
      border-radius: 8px;
      box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
      margin: 6rem auto 8.1rem auto;
      width: 329px;
    }
    #card-content {
      padding: 12px 44px;
    }
    #card-title {
      font-family: "Raleway Thin", sans-serif;
      letter-spacing: 4px;
      padding-bottom: 23px;
      padding-top: 13px;
      text-align: center;
    }
    #signup {
      font-family: "Raleway", sans-serif;
      font-size: 10pt;
      margin-top: 16px;
      text-align: center;
    }
    #submit-btn {
      background: -webkit-linear-gradient(right, #a6d9f5, #56bdf5);
      border: none;
      border-radius: 21px;
      box-shadow: 0px 1px 8px #04d9ff;
      cursor: pointer;
      color: white;
      font-family: "Raleway SemiBold", sans-serif;
      height: 42.3px;
      margin: 0 auto;
      margin-top: 50px;
      transition: 0.25s;
      width: 153px;
    }
    #submit-btn:hover {
      box-shadow: 0px 1px 18px #04d9ff;
    }
    .form {
      justify-content: flex-start;
      display: flex;
      flex-direction: column;
    }
    .form-border {
      background: -webkit-linear-gradient(right, #a6d9f5, #56bdf5);
      height: 1px;
      width: 100%;
    }
    .form-content {
      background: #fbfbfb;
      border: none;
      outline: none;
      padding-top: 14px;
    }
    .underline-title {
      background: -webkit-linear-gradient(right, #a6d9f5, #56bdf5);
      height: 2px;
      margin: -0.5rem auto 0 auto;
      width: 89px;
    }
    footer {
      border-top: 1px solid #000 !important;
      text-align: center !important;
      font-style: italic !important;
      font-size: 0.8em !important; /* Assuming the default font size is 1em, this makes the footer font size smaller */
  }
  </style>
</head>

<body>
  <div id="main">
    <?php include "inc/header.inc.php"; ?>
    <main>
      <div id="card">
        <div id="card-content">
          <div id="card-title">
            <h2>LOGIN</h2>
            <div class="underline-title"></div>
          </div>
          <form method="post" class="form" action="process_login.php">
            <?php
              echo '<label for="email" style="padding-top:13px">&nbsp;Email</label>';
              echo '<input id="email" class="form-content" type="email" name="email" autocomplete="on" required maxlength="45" placeholder="Enter email" value="' . $_SESSION["email"] . '">';
              echo '<div class="form-border"></div>';

              if (!empty($_SESSION['emailError'])) {
                echo '<label for="emailError" style="padding-top:2px; color:red;">&nbsp;' . $_SESSION["emailError"] . '</label>';
                unset($_SESSION['emailError']);
                echo '<label for="pwd" style="padding-top:10px">&nbsp;Password</label>';
              } else {
                echo '<label for="pwd" style="padding-top:34px">&nbsp;Password</label>';
              }

              echo '<input id="pwd" class="form-content" type="password" name="password" placeholder="Enter password" value="' . $_SESSION["password"] . '" required>';
              echo '<div class="form-border"></div>';

              if (!empty($_SESSION['pwError'])) {
                echo '<label for="pwError" style="padding-top:2px; color:red;">&nbsp;' . $_SESSION["pwError"] . '</label>';
                unset($_SESSION['pwError']);
                echo '<input id="submit-btn" type="submit" name="submit" value="LOGIN" style="margin-top:26px;">';
              } else {
                echo '<input id="submit-btn" type="submit" name="submit" value="LOGIN">';
              }
            ?>
            <p id="signup">New? Sign up <a href="register.php" style="color:blue;text-decoration:underline;">here</a>!</p>
          </form>
        </div>
      </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
  </div>
</body>

</html>