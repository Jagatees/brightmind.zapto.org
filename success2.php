<!DOCTYPE html>
<html>
<head>
    <title>Stripe Example</title>
    <meta charset="UTF-8" />
    <style>
        .button {
            background-color: #ffffff; /* White background */
            border: 2px solid #007bff; /* Blue border */
            color: #007bff; /* Blue text */
            padding: 10px 20px; /* Padding */
            text-align: center; /* Centered text */
            text-decoration: none; /* No underline */
            display: inline-block; /* Inline-block display */
            font-size: 16px; /* Font size */
            margin: 5px; /* Margin */
            transition-duration: 0.4s; /* Transition effect duration */
            cursor: pointer; /* Pointer cursor on hover */
            border-radius: 20px; /* Rounded corners */
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.24), 0 0 2px 0 rgba(0, 0, 0, 0.12); /* Slight shadow */
        }

        .button:hover {
            background-color: #007bff; /* Blue background on hover */
            color: #ffffff; /* White text on hover */
        }
    </style>
</head>
<body>

    <h1>Payment Success</h1>
    <p>Go to your dashboard , Under Calender to View your lessons</p>
    
    <a href="home.php" class="button">Home Page</a>
    <a href="studentDashboard.php" class="button">Dashboard</a>

</body>
</html>
