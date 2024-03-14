<!DOCTYPE html>
<html lang="en">

<!-- This is for the Nav bar to Wrap Around the Content of this Page -->
<div id="main">

<head>
    <title>Bright Minds Academy</title>
    <style>
        .blur {
        overflow: hidden;
        position: relative;
        width: 100%;

        + .blur {
            margin-top: 20px;
        }
        }

        .blurry {
        background-repeat: no-repeat;
        background-position: left top;
        background-size: cover;
        content: '';
        filter: blur(8px);
        height: 100%;
        position: absolute;
        left: 0;    
        top: 0;
        width: 50%;

        .alt & {
            background-position: left top;
            left: 0;
            right: auto;
        }

        .middle & {
            background-position: center top;
            transform: translateX(-50%);
        }
        }

        .blur img {
            display: block;
            width: 100%;
        }

        .over {
        align-items: center;
        box-sizing: border-box;
        color: white;
        display: flex;
        font-size: 20px;
        height: 100%;
        padding: 20px 120px;
        position: absolute;
        top: 0;
        left: 0;
        width: 50%;
        z-index: 1;

        .alt & {
            left: 0;
            right: auto;
        }

        .middle & {
            transform: translateX(-50%);
        }

        h2 {
            font-size: 36px;
            margin: 0;
        }
        }
        .book-now-btn {
        padding: 20px 40px;
        background-color: #ff7f50; 
        color: #fff; 
        font-size: 24px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        text-transform: uppercase; 
        font-weight: bold; 
        letter-spacing: 1px; 
    }

        .book-now-btn:hover {
            background-color: #ff6347; 
        }

                .section-below-carousel {
            background-color: #ff7f50;
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        .section-below-carousel .content {
            max-width: 800px;
            margin: 0 auto;
        }

        .section-below-carousel h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .section-below-carousel .logos {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-below-carousel .logos img {
            max-width: 100px;
            margin: 0 20px;
        }
    </style>
    <?php
        include "inc/head.inc.php";
    ?>
</head>
<body>
    <?php
        include "inc/header.inc.php";
    ?>
        
    <main class="container">
    <div class="carousel">
    <input type="radio" id="carousel-css-slide-1" name="carousel-css" value="slide-1" checked/>
    <input type="radio" id="carousel-css-slide-2" name="carousel-css" value="slide-2"/>
    <input type="radio" id="carousel-css-slide-3" name="carousel-css" value="slide-3"/>
    <!-- More Radio Buttons Here -->
    <label for="carousel-css-slide-1" data-value="slide-1"></label>
    <label for="carousel-css-slide-2" data-value="slide-2"></label>
    <label for="carousel-css-slide-3" data-value="slide-3"></label>
    <!-- More Lables Here -->
    <div class="carousel-wrapper">
        <div class="carousel-slide">
        <div class="blur">
        <img src="images/tutioncentre.jpeg" alt="" width="100%" height="100%"> 
        <span class="blurry" style="background-image: url(images/tutioncentre.jpeg)"></span>
        <div class="over">
            <div class="flex">
                <img src="images/BMALogo.png" alt="logo" width="auto" height="auto" style="padding-bottom: 50px;"/>
                <h2>The Best For Your Child</h2>
                <p> At Bright Minds Academy,  we believe that every student is capable of greatness, and we are here to guide them on their journey to success.</p>
                <button class="book-now-btn">Book Now</button>
            </div>
        </div>
        </div>
        </div>
        <div class="carousel-slide">
            <img src="images/tutioncentre.jpeg" alt="logo" width="100%" height="100%"/>
        </div>
        <div class="carousel-slide">
            <img src="images/BMALogo.png" alt="logo" width="100%" height="100%"/>
        </div>
        </div>
    </div>

    <section class="section-below-carousel">
        <div class="content">
            <h2>Our Services</h2>
            <div class="logos">
                <img src="images/chihuahua_small.jpg" alt="Partner 1 Logo">
                <img src="images/poodle_small.jpg" alt="Partner 2 Logo">
                <!-- Add more partner logos here -->
            </div>
            <p>Best in SG</p>
        </div>
    </section>

    </main>
    <?php
        include "inc/footer.inc.php";
    ?>
</div>

</body>
</html>