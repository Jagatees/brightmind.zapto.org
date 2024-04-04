<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header('Location: home.php');
    exit;
}

if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true)) {
    header('Location: login.php');
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        a {
            /* color: #007bff; */
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome</h1>
        <?php
        session_start();
        if (isset($_SESSION['user_name']) && (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true)) {
            echo "<h3>Hello, " . $_SESSION['user_name'] . "! You are now logged in!</h3>";
            // echo '<p><a href="home.php">Go Back to Main Page</a></p>';
            echo '<p>You will be redirected to our home page in <a id="counter">5</a> seconds...</p>';
            echo '<script>';
                echo 'setInterval(function() {';
                    echo 'var a = document.querySelector("#counter");';
                    echo 'var count = a.textContent * 1 - 1;';
                    echo 'a.textContent = count;';
                    echo 'if (count <= 0) {';
                        echo 'window.location.replace("http://brightmind.zapto.org/home.php");';
                    echo '}';
                echo '}, 1000);';
            echo '</script>';
        } else {
            echo "<p>Login in Success</p>";
            echo '<p><a href="home.php">Go Back to Main Page</a></p>';
        }
        ?>
    </div>
</body>
</html>
