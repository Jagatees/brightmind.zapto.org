<!DOCTYPE html>
<html lang="en">

<!-- This is for the Nav bar to Wrap Around the Content of this Page -->
<div id="main">

<head>
    <title>Bright Minds Academy</title>
    <style>

        body {
        background: -webkit-linear-gradient(bottom, #87CEEB, #dbe9f4);
        background-repeat: no-repeat;
            }
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
        padding: 30px 60px;
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
            background-color: #f8fcfc;
            color: black;
            padding: 40px 0;
            text-align: center;       
            width:100vw;
            position:relative;  
            max-width:100vw;
            left:50%;
            margin-left:-50vw;
        }

        .section-below-carousel .content {
            max-width: 800px;
            margin: 0 auto;
        }

        .section-below-carousel h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }


        .logos-section {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .logo {
            text-align: center;
            margin-right:100px;
            margin-left: 100px;
            font-family: 'Roboto';
            font-size: 20px; 
            font-weight: bold;
        }

        .logo img {
            margin-bottom: 50px;
        }


        .map
        {
            text-align:center;
            position: relative;
            padding-bottom: 56.25%; 
            height: 0;
        }

        .map iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        }
        


        #testimonials
    {
        display:flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width:100%;
    }

    .testimonial-heading
    {
        letter-spacing: 1px;
        margin: 30px 0px;
        padding: 10px 20px;
        display:flex;
        flex-direction:column;
        justify-content: center;
        align-items: center;
    }

    .testimonial-heading h1
    {
        font-size: 2.2rem;
        font-weight:500;
        background-color: #202020;
        color: #ffffff;
        padding:10px 20px;
    }

    .testimonial-heading span{
        font-size: 1.3rem;
        color:#252525;
        margin-bottom: 10px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }   

    .testimonial-box-container
    {
        display: flex;
        justify-content:center;
        align-items:center;
        flex-wrap: wrap;
        width:100%;
    }

    .testimonial-box
    {
        width:500px;
        box-shadow: 2px 2px 30px rgba(0,0,0,0.1);
        background-color: #ffffff;
        padding: 20px;
        margin: 15px;
        cursor: pointer;
    }

    .profile-img{
        width:50px;
        height: 50px;
        border-radius:50px;
        overflow:hidden;
        margin-right: 10px;
    }

    .profile-img img
    {
        width:100px;
        height:100px;
        object-fit: cover;
        object-position: center;

    }

    .profile
    {
        display:flex;
        align-items:center;
    }

    .name-user
    {
        display:flex;
        flex-direction:column;
    }

    .name-user strong
    {
        color: #3d3d3d;
        font-size:1.1rem;
        letter-spacing: 0.5px;
    }

    .name-user span
    {
        color: #979797;
        font-size: 0.8rem;
    }

    .reviews
    {
        color: #f9d71c;
    }

    .box-top
    {
        display:flex;
        justify-content: space-between;
        align-items:center;
        margin-bottom: 20px;
    }

    .student-comment p
    {
        font-size:0.9rem;
        color: #4b4b4b;
    }

    .testimonial-box:hover
    {
        transform: translateY(-10px);
        transition: all ease 0.3s;
    }

    .subject-section {
    padding: 50px 0;
    }

    .subject-box {
        display: block;
        text-align: center;
        padding: 20px;
        margin-bottom: 20px;
        color: #fff;
        text-decoration: none;
        font-size: 24px;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .math {
        background-color: #007bff; /* Blue color */
    }

    .science {
        background-color: #28a745; /* Green color */
    }

    .english {
        background-color: #17a2b8; /* Cyan color */
    }

    .mother-tongue {
        background-color: #dc3545; /* Red color */
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
        <img src="images/tutioncentre.jpeg" alt="" > 
        <span class="blurry" style="background-image: url(images/tutioncentre.jpeg)"></span>
        <div class="over">
            <div class="flex">
                <img src="images/BMALogo2.png" alt="logo" width="auto" height="auto" style="padding-bottom: 50px;"/>
                <h2>The Best For Your Child</h2>
                <p> At Bright Minds Academy,  we believe that every student is capable of greatness, and we are here to guide them on their journey to success.</p>
                <button class="book-now-btn">Book Now</button>
            </div>
        </div>
        </div>
        </div>
        <div class="carousel-slide">
            <img src="images/tutioncentre.jpeg" alt="logo" />
        </div>
        <div class="carousel-slide">
            <img src="images/BMALogo2.png" alt="logo" />
        </div>
        </div>
    </div>

    <section class="section-below-carousel bg-light py-5">
    <div class="container">
    <div class="testimonial-heading">
            <h1> What do we provide?</h1>
    </div>
        <div class="row justify-content-around">
            <div class="col-lg-4 col-md-6">
                <div class="logo text-center">
                    <img src="images/Google.png" alt="icon1" height="100px" width="210px">
                    <p>Our tution centre has been rated an average of <span style="color: orange;">5.0 stars on Google</span> with over <span style="color: orange;"> 1000 user reviews </span>. Reviews often state how easy it is to navigate and use our website.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="logo text-center">
                    <img src="images/teacher.png" alt="icon2" height="100px" width="210px">
                    <p>Our teachers are graduates from some of the <span style="color: orange;">top universities</span> around the world. They have <span style="color: orange;">many years</span> of teaching experience and are extremely passionate about teaching! Thus, our tuition centre can ensure your child is in good hands.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="logo text-center">
                    <img src="images/A+.png" alt="icon3" height="100px" width="210px">
                    <p>From data collected from all our past and current students, on average, <span style="color: orange;">80%</span> of our students score <span style="color: orange;">A+</span> for their <span style="color: orange;">PSLE</span>. 19% score a B and only 1% score less than that. We can guarantee our tuition centre provides some of the best results across Singapore!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="testimonial-heading">
            <h1> What subjects do we teach?</h1>
            <p style="font-size:20px">We provide tuition for all primary school subjects for from P1 to P6. Click a subject below to find a class session that best suits your child! </p>
    </div>  
    <section class="subject-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="math-page.html" class="subject-box math"> <img src="images/math.png" height="40px" width="60px"> Math</a>
                </div><div class="col-md-6">
                    <a href="science-page.html" class="subject-box science"> <img src="images/science.png" height="70px" width="70px"> Science</a>
                </div>
                <div class="col-md-6">
                    <a href="english-page.html" class="subject-box english">  <img src="images/english.png" height="70px" width="70px"> English</a>
                </div><div class="col-md-6">
                    <a href="mother-tongue-page.html" class="subject-box mother-tongue">  <img src="images/MT.png" height="70px" width="70px">  Mother Tongue</a>
                </div>
            </div>
        </div>
    </section>

    <div class="testimonial-heading">
        <h1>Want to find us?</h1>
        <p style="font-size:20px">Here is our address!</p>
    </div>
    <section class="map">
    <div class="embed-responsive embed-responsive-4by3">
        <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.665394053238!2d103.8462120742383!3d1.377438761488071!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da16e96db0a1ab%3A0x3d0be54fbbd6e1cd!2sSingapore%20Institute%20of%20Technology%20(SIT%40NYP)!5e0!3m2!1sen!2ssg!4v1710602407815!5m2!1sen!2ssg"  style="border:0; width:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>
    

    <section id="testimonials">
        <div class="testimonial-heading">
            <span>Comments</span>
            <h1> What do our students say?</h1>
        </div>

        <div class="testimonial-box-container">
            <div class="testimonial-box">
                <div class="box-top">
                    <div class="profile">
                        <div class="profile-img">
                            <img src="images/tabby_small.jpg">
                        </div>
                        <div class="name-user">
                            <strong> Tan Ah Ben </strong>
                            <span>@TanAhBenLoveBMA</span>
                        </div>
                    </div>
                    <div class="reviews">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                    </div>
            </div> 
            <div class="student-comment">
                <p> I really love Bright Minds Academy. Its the best. I love the teachers, they taught me maths really well. I got an A for math in my O level. I couldnt have done it without Bright Minds Academy. </p>
            </div>
            </div>

            <div class="testimonial-box">
                <div class="box-top">
                    <div class="profile">
                        <div class="profile-img">
                            <img src="images/poodle_small.jpg">
                        </div>
                        <div class="name-user">
                            <strong> Jaime Lee </strong>
                            <span>@JaimeLoveMath</span>
                        </div>
                    </div>
                    <div class="reviews">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                    </div>
            </div> 
            <div class="student-comment">
                <p>The tutors at Bright Minds Academy were really patient with me. I can also tell that they have years of experience teaching under their belt. Shoutouts to Mr Tom!</p>
            </div>
            </div>


            <div class="testimonial-box">
                <div class="box-top">
                    <div class="profile">
                        <div class="profile-img">
                            <img src="images/chihuahua_small.jpg">
                        </div>
                        <div class="name-user">
                            <strong> John Smith </strong>
                            <span>@ItsMeJohnSmith</span>
                        </div>
                    </div>
                    <div class="reviews">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                    </div>
            </div> 
            <div class="student-comment">
                <p>I have tried many tution centres for the past few years, but none has come close to what Bright Minds Academy was able to provide for me. Not only are their teachers experts at what they do, the facility at Bright Minds Academy are also of top tier. </p>
            </div>
            </div>



            <div class="testimonial-box">
                <div class="box-top">
                    <div class="profile">
                        <div class="profile-img">
                            <img src="images/calico_small.jpg">
                        </div>
                        <div class="name-user">
                            <strong> Albert Einstein </strong>
                            <span>@TheRealAlbertEinstein</span>
                        </div>
                    </div>
                    <div class="reviews">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                    </div>
            </div> 
            <div class="student-comment">
                <p> Even I, the great Albert Einstein, genius of the 19th century, the one who famously invented the theories of relativity has much to learn from the tutors at Bright Minds Academy. Especially how Mr James from my science class taught me how time travel works. </p>
            </div>
            </div>
        </div> 
        
    </section>

    </main>
    <?php
        include "inc/footer.inc.php";
    ?>
</div>

</body>
</html>