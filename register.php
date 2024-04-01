<head>
  <!--Bootstrap CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <!--Bootstrap JS-->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


  <!-- Nav Bar & Header -->
  <link rel="stylesheet" href="components/nav-bar/header.css">
  <link rel="stylesheet" href="components/nav-bar/sidebar.css">

  <link rel="stylesheet" href="components/card-grid/card.css">


  <!-- Google Material Design -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!--External JS-->
  <script src="js/main.js" defer></script>
  <script src="components/nav-bar/index.js"></script>
  <title>Bright Minds Academy</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    #uuid {
        display: none;
    }
    a {
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

    #login {
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
      align-items: left;
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
            <h2>SIGNUP</h2>
            <div class="underline-title"></div>
          </div>
          <form method="post" class="form" action="process_register.php">
            <?php
              echo '<label for="fname" style="padding-top:13px">&nbsp;First Name</label>';
              echo '<input required maxlength="45" class="form-content" type="text" id="fname" name="fname" placeholder="Enter first name" value="' . $_SESSION["fname"] . '"/>';
              unset($_SESSION['fname']);
              echo '<div class="form-border"></div>';

              if ($_SESSION['fnameError'] != "") {
                echo '<label for="fnameError" style="padding-top:2px; color:red;">&nbsp;' . $_SESSION["fnameError"] . '</label>';
                unset($_SESSION['fnameError']);
                echo '<label for="lname" style="padding-top:10px">&nbsp;Last Name</label>';
              } else {
                echo '<label for="lname" style="padding-top:34px">&nbsp;Last Name</label>';
              }
              
              echo '<input required maxlength="45" class="form-content" type="text" id="lname" name="lname" placeholder="Enter last name" value="' . $_SESSION["lname"] . '"/>';
              unset($_SESSION['lname']);
              echo '<div class="form-border"></div>';

              if ($_SESSION['lnameError'] != "") {
                echo '<label for="lnameError" style="padding-top:2px; color:red;">&nbsp;' . $_SESSION["lnameError"] . '</label>';
                unset($_SESSION['lnameError']);
                echo '<label for="email" style="padding-top:10px">&nbsp;Email</label>';
              } else {
                echo '<label for="email" style="padding-top:34px">&nbsp;Email</label>';
              }

              echo '<input id="email" class="form-content" type="email" name="email" autocomplete="on" required maxlength="45" placeholder="Enter email" value="' . $_SESSION["email"] . '" />';
              unset($_SESSION['email']);
              echo '<div class="form-border"></div>';

              if ($_SESSION['emailError'] != "") {
                echo '<label for="emailError" style="padding-top:2px; color:red;">&nbsp;' . $_SESSION["emailError"] . '</label>';
                unset($_SESSION['emailError']);
                echo '<label for="password" style="padding-top:10px">&nbsp;Password</label>';
              } else {
                echo '<label for="password" style="padding-top:34px">&nbsp;Password</label>';
              }

              echo '<input id="pwd" class="form-content" type="password" name="password" required placeholder="Enter password" value="' . $_SESSION["password"] . '" />';
              unset($_SESSION['password']);
              echo '<div class="form-border"></div>';

              if ($_SESSION['pwError'] != "") {
                echo '<label for="error" style="padding-top:2px; color:red;">&nbsp;' . $_SESSION["pwError"] . '</label>';
                unset($_SESSION['pwError']);
                echo '<label for="pwd_confirm" style="padding-top:10px">&nbsp;Confirm Password</label>';
              } else {
                echo '<label for="pwd_confirm" style="padding-top:34px">&nbsp;Confirm Password</label>';
              }

              echo '<input required class="form-content" type="password" id="pwd_confirm" name="pwd_confirm" placeholder="Confirm password" value="' . $_SESSION["cpassword"] . '" />';
              unset($_SESSION['cpassword']);
              echo '<div class="form-border"></div>';

              if ($_SESSION['cpwError'] != "") {
                echo '<label for="error" style="padding-top:2px; color:red;">&nbsp;' . $_SESSION["cpwError"] . '</label>';
                unset($_SESSION['cpwError']);
                echo '<input id="submit-btn" type="submit" name="submit" value="SIGNUP" style="margin-top:26px;"/>';
              } else {
                echo '<input id="submit-btn" type="submit" name="submit" value="SIGNUP" />';
              }
            ?>
            <p id="login">Already have an account? Log in <a href=login.php>here</a>!</p>
          </form>
        </div>
      </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
  </div>

  <script>
    function generateUUID() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c === 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }

    // Function to set UUID as value for the input field
    function setUUID() {
        var uuidInput = document.getElementById("uuid");
        if (uuidInput) {
            uuidInput.value = generateUUID();
        }
    }

    // Call setUUID function when the page loads
    window.onload = setUUID;
  </script>
</body>
