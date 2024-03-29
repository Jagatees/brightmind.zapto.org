<!DOCTYPE html>
<html lang="en">

<head>
    <title>About Us</title>
    <style>
        .card {  
            transition: background-color 0.3s ease; 
        }

        .card:hover {
            background-color: #FFFDF3; 
        }
    </style>
    <?php
    include "inc/head.inc.php";
    include "database/function.php";
    $teachers = getTeachers();
    ?>
</head>

<body>
    <div id="main">
        <?php include "inc/header.inc.php"; ?>
        
        <main class="container">
            <div class="filter-container">
                <label for="subjectFilter">Filter by subject:</label>
                <select id="subjectFilter" onchange="filterCards()">
                    <option value="all">All</option>
                    <option value="Science">Science</option>
                    <option value="English">English</option>
                    <option value="Math">Math</option>
                    <option value="MotherTongue">MotherTongue</option>
                </select>
            </div>
            <div class="grid-container">
                <?php foreach ($teachers as $teacher) : ?>
                    <div class="card" data-subject="<?php echo htmlspecialchars($teacher['subject']); ?>">
                        <img src="images/teacher/english.png" alt="Avatar" style="width:100%">
                        <div class="card-container">
                            <h4><b>
                                    <?php echo htmlspecialchars($teacher['fname']); ?>
                                </b></h4>
                            <p>Subject:
                                <?php echo htmlspecialchars($teacher['subject']); ?>
                            </p>
                            <p>Age:
                                <?php echo htmlspecialchars($teacher['age']); ?>
                            </p>
                            <p>Bio:
                                <?php echo htmlspecialchars($teacher['bio']); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
        <?php include "inc/footer.inc.php"; ?>
    </div>
    <script>
        function filterCards() {
            var selectedSubject = document.getElementById('subjectFilter').value;
            var cards = document.getElementsByClassName('card');

            for (var i = 0; i < cards.length; i++) {
                if (selectedSubject == 'all' || cards[i].getAttribute('data-subject') == selectedSubject) {
                    cards[i].style.display = '';
                } else {
                    cards[i].style.display = 'none';
                }
            }
        }
    </script>
</body>

</html>