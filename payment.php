<?php
include "database/function.php";

$price = 0;
$module = $level = $date = $uuid = '';

$lessons = getlessonsByID($_POST['lessonID']);
    
foreach ($lessons as $lesson) {

    // Access the price property of each lesson
    $price = $lesson['price'];
    $module = $lesson['module'];
    $level = $lesson['level'];
    $date = $lesson['date'];
    $uuid = $lesson['uuid'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- Include Bootstrap CSS, existing stylesheets, and additional styles -->
    <?php include "inc/head.inc.php"; // This should include your styles and Bootstrap ?>
    <script src="https://www.paypal.com/sdk/js?client-id=AR4se4kZHzxccoSPrrXXHyaJW17rZuqTV97FHFEUVjUatJOSWApEUSwiWFRzk2OfMxtNmAndbH90Jtdt&currency=USD"></script>
    
   
</head>
<body>
    <?php include "inc/header.inc.php"; // Include the header ?>
    <br>
    <br>
    <div class="container">
    <div class="row">

    <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Lesson ID</th>
                        <td><?php echo $_POST['lessonID'] ?></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="col">Subject</th>
                        <td><?php echo  $module ?></td>
                    </tr>
                    <tr>
                        <th scope="col">Date</th>
                        <td><?php echo  $date ?></td>
                    </tr>
                    <tr>
                        <th scope="col">Time</th>
                        <td><?php echo $_POST['selected_time_slot'] ?></td>
                    </tr>
                    <tr>
                        <th scope="col">price</th>
                        <td><?php echo $_POST['price'] ?></td>
                    </tr>
                </tbody>
            </table>
            
        <form action="checkout.php" method="POST">
            <input type="hidden" name="lessonID" value="<?php echo htmlspecialchars($_POST['lessonID']); ?>">
            <input type="hidden" name="module" value="<?php echo htmlspecialchars($module); ?>">
            <input type="hidden" name="uuid" value="<?php echo htmlspecialchars($uuid); ?>">
            <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">
            <input type="hidden" name="level" value="<?php echo htmlspecialchars($level); ?>">
            <input type="hidden" name="selected_time_slot" value="<?php echo htmlspecialchars($_POST['selected_time_slot']); ?>">
            <input type="hidden" name="price" value="<?php echo htmlspecialchars($_POST['price']); ?>">
            
            <button type="submit" class="btn btn-primary">Proceed to Payment</button>
        </form>
    </div>
</div>

    <?php include "inc/footer.inc.php"; // Include footer components ?>

</body>
       
</html>