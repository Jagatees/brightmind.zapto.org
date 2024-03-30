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
                        <td><?php echo  $_POST['module'] ?></td>
                    </tr>
                    <tr>
                        <th scope="col">Date</th>
                        <td><?php echo  $_POST['date'] ?></td>
                    </tr>
                    <tr>
                        <th scope="col">Time</th>
                        <td><?php echo $_POST['selected_time_slot'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div> 
        <div class="row">
            <div id="paypal-button-container"></div> <!-- PayPal button will be rendered here -->
        </div>
    </div>
    <?php include "inc/footer.inc.php"; // Include footer components ?>

</body>
<script>
        // Paypal wants people to use strings. they hate ints and floats

        paypal.Buttons({
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '0.01'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    window.location.href = 'successful.php'; 
                });
            }
        }).render('#paypal-button-container'); // This function displays Smart Payment Buttons on your web page.
    </script>
</html>