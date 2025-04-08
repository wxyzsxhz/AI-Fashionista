<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="#">
    <title>Fashionista</title>
    <!-- <link href="css/animate.css" rel="stylesheet"> -->
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link href="css/index.css" rel="stylesheet">
    <style>
        .leaf {
        position: absolute;
        width: 50px; /* Adjust size as needed */
        height: 50px; /* Adjust size as needed */
        background-image: url('image/leaf.png'); /* Ensure the path is correct */
        background-size: cover;
        z-index: 10; /* Make sure it's above other elements */
        animation: scatter 3s ease-in-out forwards;
        opacity: 0;
        }

        @keyframes scatter {
            0% {
                opacity: 1;
                transform: translate(0, 0) rotate(0deg);
            }
            100% {
                transform: translate(var(--x), var(--y)) rotate(var(--r));
                opacity: 0;
            }
        }
    </style>
    
</head>

<body>  
    <div class="container active" id="container">

        <div class="leaf" id="leaf1"></div>
        <div class="leaf" id="leaf2"></div>
        <div class="leaf" id="leaf3"></div>
        <div class="leaf" id="leaf4"></div>
        <div class="leaf" id="leaf5"></div>
        <div class="leaf" id="leaf6"></div>
        <div class="leaf" id="leaf7"></div>
        <div class="leaf" id="leaf8"></div>
        <div class="leaf" id="leaf9"></div>
        <div class="leaf" id="leaf10"></div>
        <div class="leaf" id="leaf11"></div>
        <div class="leaf" id="leaf12"></div>

        
        <header class="header">
            <a href="index.php" class="logo"> <img src="image/logo1.png" alt="" width="18%"> </a>

            <nav class="navbar">
                <a href="index.php">Home</a>

                <a href="personalized.php">Personalized</a>

                <a href="analysis.php">Analysis</a>

                <a href="about.php">About</a>
            </nav>

            <div class="toggle-icon">
                <i class='bx bx-moon'></i>
            </div>

        </header>

        <section class="home">
            <div class="home-content">
                <h3>Welcome To Your Personal AI Stylist!</h3>
                    <h1>Fashionista</h1>
                <h3>Stylish &<span>Trendy</span></h3>
                <p>Explore the latest fashion trends curated by AI Fashionista. <br> 
                Discover your new favorite looks and stay ahead of the fashion curve!</p>
                
                    <div class="button">
                    <a href="personalized.php" class="bth" data-aos="fade-up">Personalized</a>
                    <a href="analysis.php" class="bth" data-aos="fade-up">Analysis</a>
                    </div>
            </div>

            <div class="home-img">
                <img src="image/image1.png" alt="Rice" class="static">
            </div>

            <!-- <a href="orderPage.php" class="floating-cta">Style Now</a> -->

        </section>

        <footer>
            <div class="follow">
                <p>Follow us on:</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-tiktok'></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </footer>

        
    </div>

        
        <div class = "copyrightText">
        <p>© Copyright 2024 Fashionista. All Rights Reserved.</p>
        </div>

        <script>
        window.onload = function() {
    let leaves = document.querySelectorAll('.leaf');
    leaves.forEach((leaf, index) => {
        setTimeout(() => {
            let x = Math.random() * window.innerWidth - 50; // Random X position
            let y = Math.random() * window.innerHeight - 50; // Random Y position
            let r = Math.random() * 360; // Random rotation

            leaf.style.setProperty('--x', `${x}px`);
            leaf.style.setProperty('--y', `${y}px`);
            leaf.style.setProperty('--r', `${r}deg`);

            leaf.style.opacity = '1';
            leaf.style.animationDelay = `${Math.random() * 2}s`; // Random delay for each leaf
        }, index * 100); // Adjust delay between leaves
    });
};

    </script>
    <script src="index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            delay: 400
        });
    </script>
</body>
</html>