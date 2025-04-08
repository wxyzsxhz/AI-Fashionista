<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <link rel="icon" href="#">
    <title>Personalized Fashionista</title>
    <!-- <link href="css/animate.css" rel="stylesheet"> -->

    <link href="css/personalized.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <style>
        /* Style for the warning message */
        .warning {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f8c6d4;
            /* Light pink */
            color: #d21f6d;
            /* Dark pink */
            border: 2px solid #d21f6d;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-weight: bold;
            z-index: 1000;
        }
    </style>
    <script>
        function selectSkinTone(element, value) {
            document.querySelectorAll('.color-square').forEach(square => square.classList.remove('selected'));
            element.classList.add('selected');
            document.getElementById('skin_tone_input').value = value;
        }

        function selectImageOption(element, inputId, value) {
            document.querySelectorAll(`#${inputId} .image-option`).forEach(img => img.classList.remove('selected'));
            element.classList.add('selected');
            document.getElementById(inputId + '_input').value = value;
        }

        function validateForm(event) {
            let isValid = true;
            let warningMsg = document.getElementById('warning-msg');
            warningMsg.style.display = 'none';

            // Check each required field
            document.querySelectorAll('select[required], input[type="hidden"][required]').forEach(element => {
                if (!element.value) {
                    isValid = false;
                }
            });

            if (!isValid) {
                event.preventDefault();
                warningMsg.style.display = 'block';
            }
        }

        function hideWarning() {
            document.getElementById('warning-msg').style.display = 'none';
        }

        document.addEventListener('click', function(event) {
            const warningMsg = document.getElementById('warning-msg');
            if (warningMsg.style.display === 'block' && !warningMsg.contains(event.target)) {
                hideWarning();
            }
        });

        document.getElementById('warning-msg').addEventListener('click', function() {
            hideWarning();
        });
    </script>
</head>

<body>
    <div class="container active" id="container">

        <header class="header">
            <a href="index.php" class="logo1"> <img src="image/logo1.png" alt="" width="18%"> </a>

            <nav class="navbar">
                <a href="index.php">Home</a>

                <a href="personalized.php">Personalized</a>

                <a href="analysis.php">Analysis</a>

                <a href="about.php">About</a>

            </nav>

        </header>
        <section class="form">
            <!-- <div class="form-content"> -->
            <!-- Main Section -->
            <h1>Find Your Style</h1>

            <!-- Warning Message -->
            <div id="warning-msg" class="warning">Please fill in all fields before submitting.</div>

            <form method="post" action="results.php" onsubmit="validateForm(event)">
                <div class="grid-item">
                    <label for="style">Style:</label>
                    <select id="style" name="style" required>
                        <option value="Casual">Casual</option>
                        <option value="Elegant">Elegant</option>
                        <option value="Cute">Cute</option>
                        <option value="Formal">Formal</option>
                        <option value="Streetwear">Streetwear</option>
                    </select>
                </div>

                <div class="grid-item">
                    <label for="age_group">Age Group:</label>
                    <select id="age_group" name="age_group" required>
                        <option value="Teenager">Teenager</option>
                        <option value="Adult">Adult</option>
                    </select>
                </div>

                <div class="grid-item">
                    <label for="body_type">Body Type:</label>
                    <div id="body_type" class="image-options-container">
                        <img src="image/rectangle.png" alt="Rectangle" class="image-option" onclick="selectImageOption(this, 'body_type', 'Rectangle')">
                        <img src="image/pear.png" alt="Pear" class="image-option" onclick="selectImageOption(this, 'body_type', 'Pear')">
                        <img src="image/inverted_triangle.png" alt="Inverted Triangle" class="image-option" onclick="selectImageOption(this, 'body_type', 'Inverted Triangle')">
                        <img src="image/hourglass.png" alt="Hourglass" class="image-option" onclick="selectImageOption(this, 'body_type', 'Hourglass')">
                        <img src="image/apple.png" alt="Apple" class="image-option" onclick="selectImageOption(this, 'body_type', 'Apple')">
                    </div>
                    <input type="hidden" id="body_type_input" name="body_type" required>
                </div>

                <div class="grid-item">
                    <label for="face_shape">Face Shape:</label>
                    <div id="face_shape" class="image-options-container">
                        <img src="image/oval.png" alt="Oval" class="image-option" onclick="selectImageOption(this, 'face_shape', 'Oval')">
                        <img src="image/round.png" alt="Round" class="image-option" onclick="selectImageOption(this, 'face_shape', 'Round')">
                        <img src="image/square.png" alt="Square" class="image-option" onclick="selectImageOption(this, 'face_shape', 'Square')">
                        <img src="image/heart.png" alt="Heart" class="image-option" onclick="selectImageOption(this, 'face_shape', 'Heart')">
                        <img src="image/diamond.png" alt="Diamond" class="image-option" onclick="selectImageOption(this, 'face_shape', 'Diamond')">
                    </div>
                    <input type="hidden" id="face_shape_input" name="face_shape" required>
                </div>



                <div class="grid-item">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="grid-item">
                    <label for="category">Category:</label>
                    <select id="category" name="category" required>
                        <option value="Top">Top</option>#f5c1a2
                        <option value="Bottom">Bottom</option>
                        <option value="Set">Set</option>
                    </select>
                </div>
                <div class="grid-item">
                    <label for="skin_tone">Skin Tone:</label>
                    <div class="image-options-container">
                        <div class="color-square" style="background-color: #f5c1a2;" onclick="selectSkinTone(this, '#f5c1a2')"></div>
                        <div class="color-square" style="background-color: #dfb175;" onclick="selectSkinTone(this, '#dfb175')"></div>
                        <div class="color-square" style="background-color: #ae703a;" onclick="selectSkinTone(this, '#ae703a')"></div>
                        <div class="color-square" style="background-color: #ad6c44;" onclick="selectSkinTone(this, '#ad6c44')"></div>
                        <div class="color-square" style="background-color: #30150e;" onclick="selectSkinTone(this, '#30150e')"></div>
                    </div>
                    <input type="hidden" id="skin_tone_input" name="skin_tone" required>
                </div>
                <input type="submit" value="Get Recommendations">
            </form>
    </div>

    <!-- </div> -->
    </section>

    <footer>
        <div class="follow">
            <p style="text-align: center">Follow us on:</p>
            <div class="social-icons">
                <a href="#"><i class='bx bxl-facebook'></i></a>
                <a href="#"><i class='bx bxl-instagram'></i></a>
                <a href="#"><i class='bx bxl-tiktok'></i></a>
                <a href="#"><i class="fa-brands fa-viber"></i></a>
            </div>
        </div>
    </footer>
    
    <div class="copyrightText">
    <p>© Copyright 2024 Fashionista. All Rights Reserved.</p>
    </div>

</body>

</html>