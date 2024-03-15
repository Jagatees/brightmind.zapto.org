<div id="main">

<head>
  <!--Bootstrap CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!--Bootstrap JS-->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!--Custom CSS-->
    <link rel="stylesheet" href="css/carousel.css">

    <!-- Nav Bar & Header -->
    <link rel="stylesheet" href="components/nav-bar/header.css">
    <link rel="stylesheet" href="components/nav-bar/sidebar.css">

    <link rel="stylesheet" href="components/card-grid/card.css">


    <!-- Google Material Design -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--External JS-->
    <script src="js/main.js" defer></script>
    <script src="nav-bar/index.js"></script>
    <title>Bright Minds Academy</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
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
    #forgot-pass {
      color: #2dbd6e;
      font-family: "Raleway", sans-serif;
      font-size: 10pt;
      margin-top: 3px;
      text-align: right;
    }
    #card {
      background: #fbfbfb;
      border-radius: 8px;
      box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
      height: 410px;
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
  <?php include "inc/header.inc.php"; ?>
    <main>
      <div id="card">
        <div id="card-content">
          <div id="card-title">
            <h2>LOGIN</h2>
            <div class="underline-title"></div>
          </div>
          <form method="post" class="form">

            <label for="user-email" style="padding-top:13px">&nbsp;Email</label>
            <input id="email" class="form-content" type="email" name="email" autocomplete="on" required maxlength="45" />
            
            <div class="form-border"></div>
            
            <label for="user-password" style="padding-top:22px">&nbsp;Password</label>
            <input id="pwd" class="form-content" type="password" name="password" required />
            
            <div class="form-border"></div>
            
            <input id="submit-btn" type="submit" name="submit" value="LOGIN" />
            <p id="signup">New? Sign up <a href=register.php>here</a>!</p>
          </form>
        </div>
      </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>
