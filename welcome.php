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
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome</h1>
        <?php
        session_start();
        if (isset($_SESSION['user_name'])) {
            echo "<p>Hello, " . $_SESSION['user_name'] . "! Welcome to our website.</p>";
            echo '<p><a href="index.php">Logout</a></p>';
        } else {
            echo "<p>You are not logged in.</p>";
            echo '<p><a href="login.php">Login</a></p>';
        }
        ?>
    </div>
</body>
</html>
