<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bright Minds Academy - About Us</title>
    <?php
    include "inc/head.inc.php"; // Include head components
    include "db.php"; // Include database connection
    ?>
</head>
<body>
    <?php
    include "inc/header.inc.php"; // Include header components

    // Define your variables here
    $name = "John Doe";
    $age = 30; // Assuming age is stored as an integer
    $bio = "John's biography text goes here.";
    $subject = "Mathematics";
    $price = "100"; // Assuming price is stored as a string for some reason

    // Call the function to insert data into the database
    $result = insertIntoTable($name, $age, $bio, $subject, $price);

    // Prepare a message based on the result of the insert operation
    $message = $result['success'] ? "Success: " . $result['message'] : "Error: " . $result['message'];
    ?>

    <main class="container">
        <div class="grid-container">
            <div class="card">
                <img src="img_avatar.png" alt="Avatar" style="width:100%">
                <div class="card-container">
                    <h4><b>John Doe</b></h4>
                    <p>Architect & Engineer</p>
                </div>
            </div>
        </div>

        <!-- Display the message result from database operation -->
        <p><?php echo $message; ?></p>
    </main>

    <?php include "inc/footer.inc.php"; // Include footer components ?>
</body>
</html>
