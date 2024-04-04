<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "inc/head.inc.php";?>
</head>
<body>
    <?php include "inc/header.inc.php"; // Include the header ?>
    <?php
    include "database/function.php";

    if ($_SERVER['REQUEST_METHOD'] != "POST") {
        header('Location: home.php');
        exit;
    }
    
    $price = 0;
    $module = $level = $date = $uuid = '';
    $lessons = getlessonsByID($_POST['lessonID']);
    foreach ($lessons as $lesson) {
        $price = $lesson['price'];
        $module = $lesson['module'];
        $level = $lesson['level'];
        $date = $lesson['date'];
        $uuid = $lesson['uuid'];
    }
    ?>
    <div class="container">
    <div class="row">
    <h2 class="text-center mb-4">Review Your Selected Product Before Payment</h2> 
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
                <input type="hidden" name="lessonID" value="<?php echo htmlspecialchars($_POST['lessonID'] ?? ''); ?>">
                <input type="hidden" name="module" value="<?php echo htmlspecialchars($module ?? ''); ?>">
                <input type="hidden" name="uuid" value="<?php echo htmlspecialchars($uuid ?? ''); ?>">
                <input type="hidden" name="date" value="<?php echo htmlspecialchars($date ?? ''); ?>">
                <input type="hidden" name="level" value="<?php echo htmlspecialchars($level ?? ''); ?>">
                <input type="hidden" name="selected_time_slot" value="<?php echo htmlspecialchars($_POST['selected_time_slot'] ?? ''); ?>">
                <input type="hidden" name="price" value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>">
                
                <button type="submit" class="btn btn-primary" style="float: right;">Proceed to Payment</button>
            </form>
        </div>
        </div>
    <?php include "inc/footer.inc.php"; ?>
</body>
           
</html>