<!DOCTYPE html>
<html>
<head>
    <title>Stripe Example</title>
    <meta charset="UTF-8" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        
        .button {
            background-color: #ffffff; 
            border: 2px solid #007bff; 
            color: #007bff; 
            padding: 10px 20px; 
            text-align: center; 
            text-decoration: none; 
            display: inline-block; 
            font-size: 16px; 
            margin: 5px;
            transition-duration: 0.4s; 
            cursor: pointer; 
            border-radius: 20px; 
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.24), 0 0 2px 0 rgba(0, 0, 0, 0.12); 
        }

        .button:hover {
            background-color: #007bff; 
            color: #ffffff; 
        }

        .container {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Payment Success</h1>
        <p>Go to your dashboard, Under Calendar to View your lessons</p>
        
        <a href="home.php" class="button">Home Page</a>
        <a href="studentDashboard.php" class="button">Dashboard</a>
    </div>

</body>
</html>
