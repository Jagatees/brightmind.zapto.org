<!DOCTYPE html>
<html lang="en">

<?php session_start(); 
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'])) {
  header('Location: login.php');
  exit;
}
?>
<head>
  <?php
      include "inc/head.inc.php";
  ?>
  <style>
    #uuid {
        display: none;
    }
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
      margin-bottom: 1rem;
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
      width: 100px;
    }

    footer {
      border-top: 1px solid #000 !important;
      text-align: center !important;
      font-style: italic !important;
      font-size: 0.8em !important;
      /* Assuming the default font size is 1em, this makes the footer font size smaller */
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
            <h2>RESET PASSWORD</h2>
            <div class="underline-title"></div>
          </div>
          <form method="post" class="form" action="process_changepassword.php">
            <?php
              
              echo '<label for="pwd" style="padding-top:13px">&nbsp;New Password</label>';

              echo '<input id="pwd" class="form-content" type="password" name="password" required placeholder="Enter new password" value="' . $_SESSION["password"] . '">';
              unset($_SESSION['password']);
              echo '<div class="form-border"></div>';

              if (!empty($_SESSION['pwError'])) {
                echo '<label for="error" style="padding-top:2px; color:red;">&nbsp;' . $_SESSION["pwError"] . '</label>';
                unset($_SESSION['pwError']);
                echo '<label for="pwd_confirm" style="padding-top:10px">&nbsp;Confirm Password</label>';
              } else {
                echo '<label for="pwd_confirm" style="padding-top:34px">&nbsp;Confirm Password</label>';
              }
              

              echo '<input required class="form-content" type="password" id="pwd_confirm" name="pwd_confirm" placeholder="Confirm password" value="' . $_SESSION["cpassword"] . '">';
              unset($_SESSION['cpassword']);
              echo '<div class="form-border"></div>';

              if ($_SESSION['cpwError'] != "") {
                echo '<label for="error" style="padding-top:2px; color:red;">&nbsp;' . $_SESSION["cpwError"] . '</label>';
                unset($_SESSION['cpwError']);
                echo '<input id="submit-btn" type="submit" name="submit" value="RESET" style="margin-top:26px;">';
              } else {
                echo '<input id="submit-btn" type="submit" name="submit" value="RESET">';
              }
            ?>
          </form>
        </div>
      </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
  </div>
</body>

<script>
  
    function successful() {
        alert("Password changed successfully");
        window.location = "http://brightmind.zapto.org/home.php";
    }

    window.addEventListener("load", function() {
      <?php
      if($_SESSION['success']) {
        unset($_SESSION['success']);
        echo'successful();';
      }
      ?>
    });
</script>

</html>