<?php
session_start();

require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51P0D7HP2hY6yFfqMyyyMBspkDZ9mudrhMhklVMDGY1ucj0gSVBc9Vj8n01MWpWA5pWorlMZYD0g4AMrMa3ZlgaNs00JIX6wWB0";

\Stripe\Stripe::setApiKey($stripe_secret_key);

include "database/function.php";

if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] && isset($_SESSION['uuid'])) {
    $uuid_user = $_SESSION['uuid'];
}

if (!isset($_POST['module']) || !isset($_POST['date'])) {
    die('Module and date are required.');
}

$unit_amount = $_POST['price'] * 100;
$product = 'Lesson plans'; 
$timeSlot = $_POST['selected_time_slot']; 
$module = $_POST['module'];
$level = $_POST['level'];
$date = $_POST['date'];
$uuid_teacher = $_POST['uuid'];
$lessonID =  $_POST['lessonID'];


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

    // this should only be called after payment is successful
    insertBooking($uuid_user, $timeSlot, $module, $level, $date, $lessonID, $uuid_teacher);
    //update cart of lesson
    updateLessonBooking($uuid_teacher, $lessonID);

    http_response_code(303);
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
