<!DOCTYPE html>
<html lang="en">

<?php 
session_start();
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
  header('Location: home.php');
  exit;
}
?>
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
    <main style="min-height:44vh;">
      <div id="card">
        <div id="card-content">
          <div id="card-title">
            <h2>OTP LOGIN</h2>
            <div class="underline-title"></div>
          </div>
          <form method="post" class="form" action="process_otplogin.php">
            <?php
              echo '<label for="email" style="padding-top:13px">&nbsp;Email</label>';
              //echo '<p style="display:none;"> GENERATED OTP:' . $_SESSION["otp"] . '</p>';
              if (!empty($_SESSION['emailError'])) {
                echo '<input id="email" class="form-content" type="email" name="email" autocomplete="on" required maxlength="45" placeholder="Enter email" value="' . $_SESSION["email"] . '">';
                echo '<div class="form-border"></div>';
                echo '<label for="emailError" style="padding-top:2px; color:red;">&nbsp;' . $_SESSION["emailError"] . '</label>';
                unset($_SESSION['emailError']);
                echo '<input id="submit-btn" type="submit" name="submit" value="GET OTP" style="margin-top:26px;">';
              } elseif (!empty($_SESSION['otp'])) {
                echo '<input id="email" class="form-content" type="email" name="email" autocomplete="on" required maxlength="45" placeholder="Enter email" value="' . $_SESSION["email"] . '" readonly>';
                echo '<div class="form-border"></div>';
                echo '<label for="otp" style="padding-top:34px">&nbsp;One-Time Password</label>';
                echo '<input id="otp" class="form-content" type="password" name="otp" placeholder="Enter OTP" required>';
                echo '<div class="form-border"></div>';
                if (!empty($_SESSION['otpError'])) {
                  echo '<label for="otpError" style="padding-top:2px; color:red;">&nbsp;' . $_SESSION["otpError"] . '</label>';
                  unset($_SESSION['otpError']);
                  echo '<input id="submit-btn" type="submit" name="submit" value="LOGIN" style="margin-top:26px;">';
                } else {
                  echo '<input id="submit-btn" type="submit" name="submit" value="LOGIN">';
                }
              } else {
                echo '<input id="email" class="form-content" type="email" name="email" autocomplete="on" required maxlength="45" placeholder="Enter email" value="' . $_SESSION["email"] . '">';
                echo '<div class="form-border"></div>';
                echo '<input id="submit-btn" type="submit" name="submit" value="GET OTP">';
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
    window.addEventListener("load", function() {
      var otpError = "<?php echo $_SESSION['otpError'];?>";
      <?php unset($_SESSION['otpError']);?>
      if (otpError == "OTP Expired") {
        alert("OTP Expired!");
      }
    });
</script>



</html>