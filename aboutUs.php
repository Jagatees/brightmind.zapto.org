<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            body {
            font-family: Arial, sans-serif;
        }
        .about {
            background: -webkit-linear-gradient(bottom, #87CEEB, #dbe9f4);
            background-repeat: no-repeat;
            padding: 100px 0 20px 0;
            text-align: center;
        }
        .about h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .about p {
            font-size: 1rem;
            color: #323030;
            max-width: 800px;
            margin: 0 auto;
        }
        .about-info {
            margin: 2rem 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: left;
        }
        .about-img {
            width: 20rem;
            height: 20rem;
        
        }     
        .about-img img {
            width: 100%;
            height: 100%;
            border-radius: 5px;
            object-fit: contain;
        }  
        .about-info p {
            font-size: 1.3rem;
            margin: 0 2rem;
            text-align: justify;
        }
        button {
            border: none;
            outline: 0;
            padding: 10px;
            margin: 2rem;
            font-size: 1rem;
            color: white;
            background-color: #40b736;
            text-align: center;
            cursor: pointer;
            width: 15rem;
            border-radius: 4px;
        }
        button:hover {
            background-color: #1f9405;
        }
        /* Team Section */
        .team {
            padding: 30px 0;
            text-align: center;
        }
        
        .team h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        
        .team-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        
        .card {
            background-color: white;
            border-radius: 6px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            width: 18rem;
            height: 25rem;
            margin-top: 10px;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.5);
        }
        
        .card-img {
            width: 18rem;
            height: 12rem;
        }
        
        .card-img img {
            width: 100%;
            height: 100%;
            object-fit: fill;
        }
        
        .card-info button {
            margin: 2rem 1rem;
        }
        
        .card-name {
            font-size: 2rem;
            margin: 10px 0;
        }
        
        .card-role {
            font-size: 1rem;
            color: #888;
            margin: 5px 0;
        }
        
        .card-email {
            font-size: 1rem;
            color: #555;
        }
        
        
        @media (max-width: 768px) {

            .about h1 {
                font-size: 2rem;
            }
        
            .about p {
                font-size: 0.9rem;
            }
        
            .about-info {
                flex-direction: column;
                text-align: center;
            }
        
            .about-img {
                width: 60%;
                height: 60%;
                margin-bottom: 1rem;
            }
        
            .about-info p {
                margin: 1rem 2rem;
            }
        
            .about-info button {
                margin: 1rem 2rem;
                width: 10rem;
            }
        
            .team {
                margin: 0 1rem;
            }
        }
        </style>
        <?php
        include "inc/head.inc.php";
        ?>
    </head>


    <body>
    <div id="main">
        <?php
        include "inc/header.inc.php";
        ?>

        <main class="container">
        <section class="about">
        <h1>About Us</h1>
        <p style="font-weight: bold">
          Bright Minds Academy
          </p>
        <div class="about-info">
                <div class="about-img">
                    <img src=
                    "images/BMALogo2.png" alt="BMALogo">
                </div>
                <div>
                <p> 
                At Bright Minds Academy, we are dedicated to nurturing young minds and shaping the future of Singapore. As the leading primary school tuition centre in the country, we pride ourselves on our exceptional teaching methods, experienced educators, and commitment to excellence.

                Our team of passionate teachers is specially trained to cater to the unique learning needs of primary school students. We believe in creating a supportive and stimulating environment where every child can thrive academically and personally.

                With a focus on holistic education, we go beyond the traditional classroom setting to provide a well-rounded learning experience. From interactive lessons to engaging activities, we ensure that every child receives the attention and guidance they need to succeed.

                At Bright Minds Academy, we don't just teach; we inspire, motivate, and empower our students to reach their full potential. Join us on this journey of discovery and watch your child's mind shine bright!
                </p>
                </div>
            </div>
        </section>
        <section class="team">
        <h1>Meet Our Team</h1>
        <div class="team-cards">
                      
            <div class="card">
                <div class="card-img">
                        <img src=
                         "images/teacher.png" alt="User 1">
                    </div>
                    <div class="card-info">
                        <h2 class="card-name">Wang Kexiang</h2>
                        <p class="card-role">CEO and Founder</p>
                    </div>
                </div>
    
            
                <div class="card">
                    <div class="card-img">
                        <img src=
                        "images/teacher.png" alt="User 2">
                    </div>
                    <div class="card-info">
                        <h2 class="card-name">Xavier Teh Jun Ying</h2>
                        <p class="card-role">Co-Founder</p>
                    </div>
                </div>
            
            
                <div class="card">
                    <div class="card-img">
                        <img src=
                        "images/teacher.png" alt="User 3">
                    </div>
                    <div class="card-info">
                        <h2 class="card-name">Leon See Hao Jun</h2>
                        <p class="card-role">Co-Founder</p>
                    </div>
                </div>

            
                <div class="card">
                    <div class="card-img">
                        <img src=
                        "images/teacher.png" alt="User 2">
                    </div>
                    <div class="card-info">
                        <h2 class="card-name">K Jagateesvaran Rajoo</h2>
                        <p class="card-role">Co-Founder</p>
                    </div>
                </div>

            
                <div class="card">
                    <div class="card-img">
                        <img src=
                        "images/teacher.png" alt="User 2">
                    </div>
                    <div class="card-info">
                        <h2 class="card-name">Wong Che Khei</h2>
                        <p class="card-role">Co-Founder</p>
                    </div>
                </div>

            
                <div class="card">
                    <div class="card-img">
                        <img src=
                        "images/teacher.png" alt="User 2">
                    </div>
                    <div class="card-info">
                        <h2 class="card-name">Xavier Teh Jun Ying</h2>
                        <p class="card-role">Co-Founder</p>
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