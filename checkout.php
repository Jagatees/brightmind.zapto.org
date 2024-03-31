<?php

require __DIR__ . "/vendor/autoload.php";

// Set your secret key. Remember to switch to your live secret key in production!
// See your keys here: https://dashboard.stripe.com/apikeys
$stripe_secret_key = "sk_test_51P0D7HP2hY6yFfqMyyyMBspkDZ9mudrhMhklVMDGY1ucj0gSVBc9Vj8n01MWpWA5pWorlMZYD0g4AMrMa3ZlgaNs00JIX6wWB0";

\Stripe\Stripe::setApiKey($stripe_secret_key);

include "database/function.php";


if (!isset($_POST['module']) || !isset($_POST['date'])) {
    // Handle missing data, perhaps redirect back or show an error message
    die('Module and date are required.');
}


// Continue with your existing code, now using $module and $date
$unit_amount = $_POST['price'] * 100; // Assuming 'price' is correctly provided
$product = 'Lesson plans'; // Now using sanitized $module
$timeSlot = $_POST['selected_time_slot']; // Ensure this is also validated and sanitized


try {
    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://35.212.174.244/success2.php",
        "cancel_url" => "http://35.212.174.244/lessons.php",
        "locale" => "auto",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "sgd",
                    "unit_amount" => $unit_amount,
                    "product_data" => [
                        "name" => $product,
                        "description" => $timeSlot,
                    ]
                ]

            ],
        ]
    ]);

    http_response_code(303);
    // this should only be called after payment is successful
    //insertBooking($uuid, $timeSlot, $module, $level, $date, $lessonID);
    header("Location: " . $checkout_session->url);
    exit;
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle API errors (e.g., network issues or Stripe's downtime)
    error_log("Stripe API error: " . $e->getMessage());
    http_response_code(500); // Internal Server Error
    echo "An error occurred. Please try again later.";
    exit;
} catch (Exception $e) {
    // Handle any other errors (e.g., issues in your code)
    error_log("General error: " . $e->getMessage());
    http_response_code(500); // Internal Server Error
    echo "An unexpected error occurred. Please try again later.";
    exit;
}
