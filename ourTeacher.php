<!DOCTYPE html>
<html lang="en">

<div id="main">

    <head>
        <title>About Us</title>

        <?php
        include "inc/head.inc.php";
        include "database/function.php";
        $teachers = getTeachers();
        ?>
    </head>

    <body>
        <?php
        include "inc/header.inc.php";
        ?>

        <main class="container">
            <div class="grid-container">
                <?php foreach ($teachers as $teacher): ?>
                    <div class="card">
                        <img src="img_avatar.png" alt="Avatar" style="width:100%">
                        <div class="card-container">
                            <h4><b>
                                    <?php echo htmlspecialchars($teacher['name']); ?>
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
        <?php
        include "inc/footer.inc.php";
        ?>
</div>

</body>

</html>