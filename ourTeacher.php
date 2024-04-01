<!DOCTYPE html>
<html lang="en">

<head>
    <title>OurTeachers</title>
    <style>
        .card {  
            transition: background-color 0.3s ease; 
        }
        h1 {
            padding-top: 20px;
            padding-bottom: 20px;
            text-align: center;
        }
        h4 {
            padding-top: 10px;
        }
        .filter-container {
            display: flex;
            justify-content: center; 
            align-items: center; 
            margin: 20px; 
        }

        .filter-container button {
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
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.24), 0 0 2px 0 rgba(0, 0, 0, 0.12); /* Slight shadow for depth */
        }

        .filter-container button:hover {
            background-color: #007bff;
            color: #ffffff; 
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
            <h1>Our Teachers</h1>
            <div class="filter-container">
                <button onclick="filterCards('all')">All</button>
                <button onclick="filterCards('Science')">Science</button>
                <button onclick="filterCards('English')">English</button>
                <button onclick="filterCards('Math')">Math</button>
                <button onclick="filterCards('MotherTongue')">Mother Tongue</button>
            </div>

            <div class="grid-container">
                <?php foreach ($teachers as $teacher) : ?>
                    <div class="card" data-subject="<?php echo htmlspecialchars($teacher['subject']); ?>">
                        <div class="card-container" style="padding: 0px">
                            <img src="images/teacher/english.png" alt="Avatar" style="width:100%">
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
      function filterCards(selectedSubject) {
        var cards = document.getElementsByClassName('card');

        for (var i = 0; i < cards.length; i++) {
            if (selectedSubject == 'all' || cards[i].getAttribute('data-subject') === selectedSubject) {
                cards[i].style.display = '';
            } else {
                cards[i].style.display = 'none';
            }
        }
    }

    </script>
</body>

</html>