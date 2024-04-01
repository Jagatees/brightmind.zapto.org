<?php
session_start();
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true)) {
    header('Location: login.php');
    exit; // Make sure to terminate the script
}

include "database/function.php";

$lessons = getlessons();
$allLessonsJSON = json_encode($lessons, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bright Minds Academy - Lessons</title>
    <link rel="stylesheet" href="css/lessons.css">
    <?php include "inc/head.inc.php"; ?>
</head>
<body>
<div id="main">

    <?php include "inc/header.inc.php"; ?>
    <br>
    <br>
    <div id="main">
        <div class="container">
            <div class="row">
                <h4>Book Lessons</h4>
                <br><br>
                <form method="POST" action="payment.php">
                    <div id="lessonCardsContainer" class="row">
                    </div>
                    <input type="text" id="price" name="price" value="" hidden>
                    <input type="text" id="selected_time_slot" name="selected_time_slot" value="" hidden>
                    <input type="text" id="lessonID" name="lessonID" value="" hidden>
                    <button type="submit" class="btn btn-primary" style="float:right;">Book Lesson</button>
                </form>
            </div>
        </div>        
    </div>
    <br>
    </main>

    <?php include "inc/footer.inc.php"; ?>
    <script>
        // JavaScript to dynamically load lesson cards
        var lessonsData = <?php echo $allLessonsJSON; ?>;

        var lessonCardsContainer = document.getElementById('lessonCardsContainer');

        lessonsData.forEach(function(lesson) {
            if (lesson.approvel == '1')
            {
                var cardDiv = document.createElement('div');
                cardDiv.classList.add('col-sm-4');

                var cardHTML = `
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">Subject :${lesson.module}</div>
                        <div class="card-body">
                            <p class="card-text">Lesson ID: ${lesson.lesson_id}</p>
                            <p class="card-text">Tutor Name: ${lesson.teacher_name}</p>
                            <p class="card-text">Price: $ ${lesson.price}</p>
                            <p class="card-text">Date: ${lesson.date}</p>
                            `;
                
                const time_slot_array = lesson.time_slot.split("|");
                
                for (let i = 0; i < time_slot_array.length; i ++)
                {
                    if (time_slot_array[i] != '')
                    {
                        cardHTML += `
                        <button type="button" onclick="selectTimeSlot(this, ${lesson.lesson_id}, ${lesson.price})" class="btn btn-light">${time_slot_array[i]}</button><br><br>`;
                    }
                }
                cardHTML += `
                            <!-- You can add additional buttons or content here if needed -->
                        </div>
                    </div>
                `;
            }
            
            cardDiv.innerHTML = cardHTML;
            lessonCardsContainer.appendChild(cardDiv);
        });

        function selectTimeSlot(element, lessonID, price){
            const btnList = document.querySelectorAll('.btn-light');
            btnList.forEach(btn => {
                btn.classList.remove('active');
            });

            element.classList.add('active');
            document.getElementById('lessonID').value = lessonID;
            document.getElementById('selected_time_slot').value = element.innerHTML;
            document.getElementById('price').value = price;
        }
    </script>
</body>
</html>
