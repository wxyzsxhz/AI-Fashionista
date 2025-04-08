<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="#">
    <title>Style Ananlysis</title>
    <!-- <link href="css/clone.css" rel="stylesheet"> -->
    <link href="css/analysis.css" rel="stylesheet">
    <link href="css/test.css" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <style>
         .image-options-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .color-square {
            width: 50px;
            height: 50px;
            display: inline-block;
            border: 2px solid transparent;
            border-radius: 50%;
            cursor: pointer;
            margin: 5px;
            transition: transform var(--transition-speed);
        }

        .color-square:hover {
            transform: scale(1.1);
        }
        .color-sq{
            width: 20px;
            height: 20px;
            display: inline-block;
            border: 2px solid transparent;
            border-radius: 20%;
            cursor: pointer;
        
            transition: transform var(--transition-speed);
        }

    </style>
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

        <div class="slider">
            <div class="slider-wrapper">

                <!-- Body Type Selection Form -->
                <section class="form">
                    <div class="form-content">
                        <h1>Body Type</h1><br>
                        <h3>Select Your Body Type to Find the Perfect Clothing Items</h3><br>
                        <form id="clothingForm" method="POST" action="">
                            <!-- Body Type Selection -->
                            <label for="bodyType" style="text-align:center;">Choose body type:</label>

                            <div id="bodyTypeSelection">
                                <div class="body-type" data-body="Rectangle" onclick="selectBodyType('Rectangle')">
                                    <img src="image/rectangle.png" alt="Rectangle Body">
                                    <p>Rectangle</p>
                                </div>
                                <div class="body-type" data-body="Pear" onclick="selectBodyType('Pear')">
                                    <img src="image/pear.png" alt="Pear Body">
                                    <p>Pear</p>
                                </div>
                                <div class="body-type" data-body="Inverted Triangle" onclick="selectBodyType('Inverted Triangle')">
                                    <img src="image/inverted_triangle.png" alt="Inverted Triangle Body">
                                    <p>Inverted Triangle</p>
                                </div>
                                <div class="body-type" data-body="Hourglass" onclick="selectBodyType('Hourglass')">
                                    <img src="image/hourglass.png" alt="Hourglass Body">
                                    <p>Hourglass</p>
                                </div>
                                <div class="body-type" data-body="Apple" onclick="selectBodyType('Apple')">
                                    <img src="image/apple.png" alt="Apple Body">
                                    <p>Apple</p>
                                </div>
                            </div>

                            <!-- Hidden input to store selected body type -->
                            <input type="hidden" name="bodyType" id="bodyTypeInput" value="">
                            <div class="button-container">
                            <!-- Gender Selection -->
                                <label for="Bodygender" style="text-align:center;"><br>Choose gender:</label>
                                <select name="Bodygender" id="Bodygender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="All">Other</option>
                                </select>
                                <div class="btn1">
                                <button type="submit" name="action" value="findClothing">Find Clothing Items</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Style for Body Type Selection -->
                    <style>
                        #bodyTypeSelection {
                            display: flex;
                            justify-content: space-around;
                            margin-top: 20px;
                        }

                        .body-type {
                            text-align: center;
                            cursor: pointer;
                        }

                        .body-type img {
                            width: 100px;
                            height: 150px;
                            border: 2px solid transparent;
                            border-radius: 10px;
                            transition: border-color 0.3s;
                        }

                        .body-type img.selected {
                            border-color: #ff69b4; /* Pink border for selected item */
                        }

                        .body-type p {
                            margin-top: 10px;
                            font-size: 16px;
                            font-weight: bold;
                        }
                    </style>

                    <script>
                        document.getElementById('clothingForm').addEventListener('submit', function(event) {
                            var bodyType = document.getElementById('bodyTypeInput').value;
                            
                            if (!bodyType) {
                                event.preventDefault(); // Prevent form submission
                                
                                // Show the modal
                                document.getElementById('messageModal').style.display = 'flex';
                            }
                        });

                        // Close the modal when the user clicks the OK button
                        document.getElementById('closeModal').addEventListener('click', function() {
                            document.getElementById('messageModal').style.display = 'none';
                        });
                    </script>

                    <!-- JavaScript to Handle Body Type Selection -->
                    <script>
                        function selectBodyType(bodyType) {
                            // Update the hidden input field
                            document.getElementById('bodyTypeInput').value = bodyType;

                            // Remove the 'selected' class from all images
                            const bodyImages = document.querySelectorAll('#bodyTypeSelection .body-type img');
                            bodyImages.forEach(img => img.classList.remove('selected'));

                            // Add the 'selected' class to the clicked image
                            const selectedImage = document.querySelector(`[data-body="${bodyType}"] img`);
                            selectedImage.classList.add('selected');
                        }
                    </script>

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $action = $_POST['action'] ?? '';
                        $bodyType = $_POST['bodyType'] ?? '';
                        $TyGender = $_POST['Bodygender'] ?? '';

                        if ($action == "findClothing") {
                            $GEN = $_POST['Bodygender'];
                            $bodyType = $_POST['bodyType'];
                            
                            // Validate input
                             if (empty($bodyType)) {
                                 echo "<p>Please select a body type before searching for clothing items.</p>";
                                 exit;
                             }

                            // Query logic based on gender and body type
                            if ($TyGender == "All") {
                                $query = "clothing_items_for_body_type('$bodyType', Items), writeln(Items).";
                            } else {
                                $query = "find_items_by_gender_and_body_type('$TyGender', '$bodyType', Items), writeln(Items).";
                            }

                            // Execute Prolog query and fetch results
                            $command = "\"C:/Program Files/swipl/bin/swipl.exe\" -s C:/xampp/htdocs/fashionista/example.pl -g \"$query\" -t halt.";
                            $output = shell_exec($command);

                            // Clean up the Prolog output
                            $output = trim($output);
                            $output = str_replace(["[", "]", "\n", "\r"], '', $output); // Remove brackets and newlines
                            $itemsArray = explode(',', $output); // Split by commas to get individual items
                            
                            // Prepare custom messages for each body type
                            $customMessages = [
                                'Rectangle' => "For the <strong><span>$GEN</span></strong> <strong><span>Rectangle</span></strong> body type, explore clothing that creates curves and adds definition.<br><br>",
                                'Pear' => "<strong><span>$GEN</span></strong> <strong><span>Pear</span></strong> body type looks fantastic with clothing that highlights your upper body while balancing proportions.<br><br>",
                                'Inverted Triangle' => "For the <strong><span>$GEN</span></strong> <strong><span>Inverted Triangle</span></strong> body type, choose clothing that adds volume to your lower body.<br><br>",
                                'Hourglass' => "Embrace <strong><span>$GEN</span></strong> <strong><span>Hourglass</span></strong> figure with clothing that highlights your curves.<br><br>",
                                'Apple' => "For the <strong><span>$GEN</span></strong> <strong><span>Apple</span></strong> body type, find clothing that defines your waistline.<br><br>"
                            ];

                            // Output results
                            if (!empty($itemsArray)) {
                                // Remove duplicates and trim extra spaces
                                $uniqueItems = array_unique(array_map('trim', $itemsArray));

                                $message = isset($customMessages[$bodyType]) ? $customMessages[$bodyType] : "Here are some recommended clothing items:";
                                echo "<p><span>$message</span> We recommend the following items: </p><br>";

                                foreach ($uniqueItems as $item) {
                                    if (!empty($item)) {
                                        echo '<strong class="xyz">' . htmlspecialchars($item) . '</strong><br>';
                                    }
                                }
                            } else {
                                echo "<p>Unfortunately, we currently don't have any clothing items available for the <strong><span>$bodyType</span></strong> body type. Please check back soon.</p>";
                            }
                        }
                    }
                    ?>
                

                <!-- Modal Structure -->
                <div id="messageModal" class="modal">
                    <div class="modal-content">
                        <p>Please select a body type before searching for clothing items.</p>
                        <button id="closeModal" class="close-button">OK</button>
                    </div>
                </div>

                <!--Message Pop-up Box-->
                <script>
                    // Function to show the modal
                    function showModal() {
                        document.getElementById('messageModal').style.display = 'flex'; // Show modal
                    }

                    // Function to hide the modal
                    function hideModal() {
                        document.getElementById('messageModal').style.display = 'none'; // Hide modal
                    }

                    // Close the modal when the "OK" button is clicked
                    document.getElementById('closeModal').addEventListener('click', function() {
                        hideModal(); // Hide modal on OK button click
                    });

                    // Prevent form submission and show modal if body type is not selected
                    document.getElementById('clothingForm').addEventListener('submit', function(event) {
                        var bodyType = document.getElementById('bodyTypeInput').value; // Get the selected body type
                        
                        if (!bodyType) {
                            event.preventDefault(); // Prevent form submission
                            showModal(); // Show the modal if no body type is selected
                        }
                    });
                </script>
            </section>


                <!-- Skin Tone Selection Form -->
<section class="form">
    <div class="form-content">
        <h1>Skin Tone</h1><br>
        <h3>Select Your Skin Tone to Find Your Personal Color</h3><br>
        <form id="skinToneForm" method="POST" action="">
            <!-- Hidden input to store selected skin tone -->
            <input type="hidden" name="skinTone" id="skinToneInput" value="">

            <!-- Skin Tone Selection -->
            <div class="skin-tone-options">
                <div class="skin-tone" data-color="#f5c1a2" style="background-color: #f5c1a2;" onclick="selectSkinTone(this, '#f5c1a2')"></div>
                <div class="skin-tone" data-color="#dfb175" style="background-color: #dfb175;" onclick="selectSkinTone(this, '#dfb175')"></div>
                <div class="skin-tone" data-color="#ae703a" style="background-color: #ae703a;" onclick="selectSkinTone(this, '#ae703a')"></div>
                <div class="skin-tone" data-color="#ad6c44" style="background-color: #ad6c44;" onclick="selectSkinTone(this, '#ad6c44')"></div>
                <div class="skin-tone" data-color="#30150e" style="background-color: #30150e;" onclick="selectSkinTone(this, '#30150e')"></div>
            </div>

            <div class="button-container">
                <div class="btn2">
                <button type="submit" name="action" value="findColors">Find Colors</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Structure -->
    <div id="skinToneModal" class="modal">
        <div class="modal-content">
            <p>Please select a skin tone before searching for colors.</p>
            <button id="closeSkinToneModal" class="close-button">OK</button>
        </div>
    </div>

    <style>
        .skin-tone-options {
            display: flex;
            gap: 30px;
            margin-bottom: 20px;
            margin-left: 270px;
        }
        .skin-tone {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border 0.3s ease;
        }
        .skin-tone.selected {
            border: 2px solid #ff69b4;
        }
        
    </style>

    <script>
        // Function to select a skin tone
        function selectSkinTone(element, color) {
            document.getElementById('skinToneInput').value = color;
            
            // Remove 'selected' class from all tones
            document.querySelectorAll('.skin-tone').forEach(st => st.classList.remove('selected'));

            // Add 'selected' class to the clicked tone
            element.classList.add('selected');
        }

        // Function to show the modal
        function showSkinToneModal() {
            document.getElementById('skinToneModal').style.display = 'flex';
        }

        // Function to hide the modal
        function hideSkinToneModal() {
            document.getElementById('skinToneModal').style.display = 'none';
        }

        // Show modal if skin tone is not selected
        document.getElementById('skinToneForm').addEventListener('submit', function(event) {
            var skinTone = document.getElementById('skinToneInput').value;
            if (!skinTone) {
                event.preventDefault(); // Prevent form submission
                showSkinToneModal();    // Show the modal
            }
        });

        // Hide modal when OK is clicked
        document.getElementById('closeSkinToneModal').addEventListener('click', hideSkinToneModal);
    </script>
                    
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $action = $_POST['action'] ?? '';

                    if ($action == "findColors") {
                        $skinTone = trim($_POST['skinTone'] ?? '');

                        if (empty($skinTone)) {
                            echo "<p>Please provide a skin tone.</p>";
                        } elseif (!preg_match('/^[a-zA-Z0-9#]+$/', $skinTone)) {
                            echo "<p>Invalid skin tone format. Please enter a valid skin tone.</p>";
                        } else {
                            // Queries to Prolog
                            $querySuitable = "suitable_colors_for_skin_tone('$skinTone', SuitableColors), writeln(SuitableColors).";
                            $queryUnsuitable = "unsuitable_colors_for_skin_tone('$skinTone', UnsuitableColors), writeln(UnsuitableColors).";

                            // Execute Prolog commands
                            $commandSuitable = "\"C:/Program Files/swipl/bin/swipl.exe\" -s C:/xampp/htdocs/fashionista/example.pl -g \"$querySuitable\" -t halt.";
                            $commandUnsuitable = "\"C:/Program Files/swipl/bin/swipl.exe\" -s C:/xampp/htdocs/fashionista/example.pl -g \"$queryUnsuitable\" -t halt.";

                            // Get the output from Prolog
                            $outputSuitable = shell_exec($commandSuitable);
                            $outputUnsuitable = shell_exec($commandUnsuitable);

                            

                            // Trim and handle the output
                            $suitableColors = trim($outputSuitable);
                            $unsuitableColors = trim($outputUnsuitable);

                            echo "<h3>Skin Tone: <strong class='color-sq' style='background-color: $skinTone;'></strong></h3>";

                            // Handle suitable colors
                            if (strpos($suitableColors, '[]') === false && !empty($suitableColors)) {
                                // Remove list syntax from Prolog output
                                $suitableColors = str_replace(['[', ']', "'"], '', $suitableColors);
                                $suitableColorsList = implode(", ", array_map('htmlspecialchars', explode(",", $suitableColors)));
                                echo "<p>For the skin tone <strong class='color-sq' style='background-color: $skinTone;'></strong>, the following colors are considered suitable: <br><br><strong>$suitableColorsList</strong>. <br><br>These colors are carefully selected to enhance and complement your natural complexion. Incorporating these colors into your wardrobe will help you achieve a polished and harmonious look that aligns with your skin tone, making your appearance more vibrant and flattering.</p>";
                            } else {
                                echo "<p>No suitable colors found for this skin tone. It might be worth exploring other shades or consulting color guides that match different undertones and personal preferences to find a more appropriate palette.</p>";
                            }

                            // Handle unsuitable colors
                            if (strpos($unsuitableColors, '[]') === false && !empty($unsuitableColors)) {
                                // Remove list syntax from Prolog output
                                $unsuitableColors = str_replace(['[', ']', "'"], '', $unsuitableColors);
                                $unsuitableColorsList = explode(',', $unsuitableColors);

                                echo "<p>For the skin tone <strong class='color-sq' style='background-color: $skinTone;'></strong>, it is advisable to avoid the following color(s):<br><br>";
                                
                                foreach ($unsuitableColorsList as $color) {
                                    $color = trim(htmlspecialchars($color)); // Ensure the color is sanitized
                                    echo "<strong class='color-sq' style='background-color: $color;'></strong> ";
                                    
                                    // Optional: Provide descriptions for specific colors
                                    switch ($color) {
                                        case '#f5c1a2':
                                            echo "This color might not complement your skin tone well. It can create a washed-out effect, making you appear less vibrant.<br>";
                                            break;
                                        case '#dfb175':
                                            echo "This warm shade may contrast too strongly with your complexion, potentially making your skin look uneven.<br>";
                                            break;
                                        case '#ae703a':
                                            echo "This rich color might overpower your natural skin tone and may not harmonize well with your features.<br>";
                                            break;
                                        case '#ad6c44':
                                            echo "Deep hues like this can create a stark contrast with your skin tone, which might not be flattering.<br>";
                                            break;
                                        case '#30150e':
                                            echo "Bold and dark colors such as this one can dominate your look and might not suit your complexion.<br>";
                                            break;
                                        default:
                                            echo "Avoid this color as it may not enhance your skin tone.<br>";
                                    }
                                    echo "<br/>";
                                }
                                echo "</p>";
                            } else {
                                echo "<p>No unsuitable colors found for this skin tone.</p>";
                            }
                        }
                    }
                }
                ?>

</section>
            
            <!-- Form 3: Select Gender and Style -->
            <section class="form">
                <div class="form-content">
                
                    <!-- Banner Section with 5 Images -->
                    <style>
                    /* Styles for the banner section */
                    .banner {
                        border-radius:10px; 
                        max-width: 100%; /* Ensure the banner spans the full width of its container */
                        display: flex;
                        justify-content: center; /* Center the images in the banner */
                        gap: 0; /* Remove space between images */
                        margin-bottom: 20px; /* Adds space below the banner */
                        overflow: hidden; /* Ensures the banner stays inside the frame */
                    }

                    /* Styles for the images inside the banner */
                    .banner img {
                        width: 1in;  /* Set the width to 1 inch */
                        height: 2in; /* Set the height to 2 inches */
                        
                        margin: 0; /* Remove any margins around images */
                        object-fit: cover; /* Ensures images fit properly within their dimensions */
                    }

                    /* Optional container to ensure consistent alignment and centering */
                    .container {
                        display: flex;
                        justify-content: center; /* Centers the entire banner within the container */
                        width: 100%;
                    }
                    </style>

                    <h1>Clothing Items</h1><br>

                    <section class="banner">
                        <img src="image/image11.png" alt="Image 1">
                        <img src="image/image12.png" alt="Image 2">
                        <img src="image/image13.png" alt="Image 3">
                        <img src="image/image14.png" alt="Image 4">
                        <img src="image/image15.png" alt="Image 5">
                        <img src="image/image16.png" alt="Image 6">
                        <img src="image/image17.png" alt="Image 7">
                        <img src="image/image18.png" alt="Image 8">
                    </section><br>

                    <h3>Select Gender and Style to Find Clothing Items</h3><br><br>
        
                    <form id="clothingStyle" method="POST" action="">
                       <div class="button-container">
                       <label for="style" style="text-align:center">Choose style:</label>
                    
                            <select name="style" id="style">
                                <option value="Casual">Casual</option>
                                <option value="Formal">Formal</option>
                                <option value="Elegant">Elegant</option>
                                <option value="Cute">Cute</option>
                                <option value="Streetwear">Streetwear</option>
                            </select>

                            <label for="gender" style="text-align:center">Choose gender:</label>
                            <select name="gender" id="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="All">Other</option>
                            </select>
                            <div class="btn3">
                                <button type="submit" name="action" value="findItems">Find Clothing Items</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Structure -->
                <div id="clothingModal" class="modal">
                    <div class="modal-content">
                        <p>Please select both gender and style before searching for clothing items.</p>
                        <button id="closeClothingModal" class="close-button">OK</button>
                    </div>
                </div>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $action = $_POST['action'] ?? '';

                    if ($action == "findItems") {
                        $gender = $_POST['gender'];
                        $style = $_POST['style'];
                        if ($gender == "All") {
                            $query = "find_all_items_by_style('$style', Items), writeln(Items).";
                        } else {
                            $query = "find_all_items_by_gender_and_style('$gender', '$style', Items), writeln(Items).";
                        }
                        $command = "\"C:/Program Files/swipl/bin/swipl.exe\" -s C:/xampp/htdocs/fashionista/example.pl -g \"$query\" -t halt.";
                        $output = shell_exec($command);
                        $items = trim($output, "[]\n");

                        // Remove duplicates
                        $items = str_replace("'", "", $items);
                        $itemsArray = array_unique(array_map('trim', explode(",", $items)));

                        echo "<h3>Recommended Items for <strong><span>$gender</span></strong> and Style: <strong><span>$style</span></strong></h3><br>";
                        if (!empty($itemsArray)) {
                            foreach ($itemsArray as $itemList) {
                                if (!empty($itemList)) {
                                    echo '<strong class="xyz">' . htmlspecialchars($itemList) . '</strong><br>';
                                }
                            }
                        } else {
                            echo "<p>No clothing items found for gender <strong>$gender</strong> and style <strong>$style</strong>. This may be due to a limited selection in our current inventory. We encourage you to try different combinations or explore other styles to find pieces that perfectly suit your fashion needs.</p>";
                        }
                    }
                }
                ?>
            </section>



                <!-- Form 4: Select Face Shape for Haircuts -->
            <section class="form">
                <div class="form-content">
                    <h1>Haircuts</h1><br>
                    <h3>Select Your Face Shape to Find Haircuts</h3><br>

                     <form id="hairCutForm" method="POST" action="">
                        <!-- Face Shape Selection with Clickable Images -->
                        <label for="faceshape" style="text-align:center;">Choose face shape:</label>
                        <div id="faceShapeSelection">
                            <div class="face-shape" data-face="round" onclick="selectFaceShape('round')">
                                <img src="image/round.png" alt="Round Face Shape">
                                <p>Round</p>
                            </div>
                            <div class="face-shape" data-face="oval" onclick="selectFaceShape('oval')">
                                <img src="image/oval.png" alt="Oval Face Shape">
                                <p>Oval</p>
                            </div>
                            <div class="face-shape" data-face="square" onclick="selectFaceShape('square')">
                                <img src="image/square.png" alt="Square Face Shape">
                                <p>Square</p>
                            </div>
                            <div class="face-shape" data-face="heart" onclick="selectFaceShape('heart')">
                                <img src="image/heart.png" alt="Heart Face Shape">
                                <p>Heart</p>
                            </div>
                            <div class="face-shape" data-face="diamond" onclick="selectFaceShape('diamond')">
                                <img src="image/diamond.png" alt="Diamond Face Shape">
                                <p>Diamond</p>
                            </div>
                        </div>

                        <!-- Hidden input to store the selected face shape -->
                        <input type="hidden" name="faceshape" id="faceShapeInput" value="">
                        <br><br>

                        <!-- Gender Selection -->
                        <div class="button-container">
                            <label for="Fagender" style="text-align:center;">Choose gender:</label>
                            <select name="Fagender" id="Fagender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="All">Other</option>
                            </select>

                            <div class="btn4">
                                <button type="submit" name="action" value="findHaircuts">Find Haircuts</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Structure for Face Shape Selection -->
                <div id="haircutModal" class="modal">
                    <div class="modal-content">
                        <p>Please select a face shape before searching for haircuts.</p>
                        <button id="closeHaircutModal" class="close-button">OK</button>
                    </div>
                </div>

                <!-- CSS for Styling -->
                <style>
                    #faceShapeSelection {
                        display: flex;
                        justify-content: space-around;
                        margin-top: 20px;
                    }

                    .face-shape {
                        text-align: center;
                        cursor: pointer;
                    }

                    .face-shape img {
                        width: 100px;
                        height: 150px;
                        border: 2px solid transparent;
                        border-radius: 10px;
                        transition: border-color 0.3s;
                    }

                    .face-shape img.selected {
                        border-color: #ff69b4; /* Pink border for the selected face shape */
                    }
                </style>

                <!-- JavaScript for Face Shape Selection and Modal -->
                <script>
                    function selectFaceShape(faceShape) {
                        // Set the hidden input field with the selected face shape value
                        document.getElementById('faceShapeInput').value = faceShape;

                        // Remove the 'selected' class from all images
                        const faceImages = document.querySelectorAll('#faceShapeSelection .face-shape img');
                        faceImages.forEach(img => img.classList.remove('selected'));

                        // Add the 'selected' class to the clicked image
                        const selectedImage = document.querySelector(`[data-face="${faceShape}"] img`);
                        selectedImage.classList.add('selected');
                    }

                    function showHaircutModal() {
                        document.getElementById('haircutModal').style.display = 'flex';
                    }

                    function hideHaircutModal() {
                        document.getElementById('haircutModal').style.display = 'none';
                    }

                // Show modal if face shape is not selected
                document.getElementById('hairCutForm').addEventListener('submit', function(event) {
                    var faceShape = document.getElementById('faceShapeInput').value;
                    if (!faceShape) {
                        event.preventDefault(); // Prevent form submission
                        showHaircutModal();    // Show the modal
                    }
                });

                // Hide modal when OK is clicked
                document.getElementById('closeHaircutModal').addEventListener('click', hideHaircutModal);
            </script>

            <!-- JavaScript to handle face shape selection -->
            <script>
                function selectFaceShape(faceShape) {
                    // Set the hidden input field with the selected face shape value
                    document.getElementById('faceShapeInput').value = faceShape;

                    // Remove the 'selected' class from all images
                    const faceImages = document.querySelectorAll('#faceShapeSelection .face-shape img');
                    faceImages.forEach(img => img.classList.remove('selected'));

                    // Add the 'selected' class to the clicked image
                    const selectedImage = document.querySelector(`[data-face="${faceShape}"] img`);
                    selectedImage.classList.add('selected');
                }
            </script>
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $action = $_POST['action'] ?? '';
                $faceShape = trim($_POST['faceshape'] ?? '');
                $fagender = trim($_POST['Fagender'] ?? '');

                // Validate inputs
                if ($action != "findHaircuts") {
                    echo "<p></p>";
                } elseif (empty($faceShape)) {
                    echo "<p>Please select a face shape.</p>";
                } 
                else {
                    // Sanitize inputs for use in queries
                    $faceShape = htmlspecialchars($faceShape, ENT_QUOTES, 'UTF-8');
                    $fagender = htmlspecialchars($fagender, ENT_QUOTES, 'UTF-8');

                    if ($fagender == "All") {
                        $query = "find_haircut_by_face_shape_only('$faceShape', Haircuts), writeln(Haircuts).";
                    } else {
                        $query = "find_haircut_by_face_shape('$fagender', '$faceShape', Haircuts), writeln(Haircuts).";
                    }

                    $command = "\"C:/Program Files/swipl/bin/swipl.exe\" -s C:/xampp/htdocs/fashionista/example.pl -g \"$query\" -t halt.";
                    $output = shell_exec($command);
                    $haircutList = trim($output, "[]\n"); 

                    echo "<h3>Recommended Haircuts for <strong><span>$fagender</span></strong> with a <strong><span>$faceShape</span></strong> Face Shape</h3>";

                    if (!empty($haircutList)) {
                        $haircutList = str_replace("'", "", $haircutList);
                        echo "<p>We’ve carefully selected a range of haircuts specifically designed to enhance your unique <strong><span>$faceShape</span></strong> face shape and match your <strong><span>$fagender</span></strong> style. <br> <br> Our recommendations are based on the latest trends and timeless classics, ensuring that you find a style that not only complements your facial features but also aligns with your personal taste.</p>";
                        echo "<p>Here are some of the top haircut styles that are perfect for your face shape:</p><br>";
                        foreach (explode(",", $haircutList) as $haircut) {
                            if (!empty(trim($haircut))) {
                                echo '<strong class="xyz">' . htmlspecialchars(trim($haircut)) . '</strong><br>';
                            }
                        }
                    } else {
                        echo "<p>We’re sorry, but it seems we don’t have any specific haircut recommendations for the selected face shape and gender at the moment. This could be due to a limited selection or the need to adjust your criteria.</p>";
                        echo "<p>We encourage you to explore different face shapes or gender options to see a wider range of recommendations. Additionally, seeking advice from our style experts could provide you with personalized suggestions that cater to your individual needs and preferences. Don’t hesitate to reach out for expert guidance to help you find the ideal haircut that enhances your look and complements your features.</p>";
                    }
                }
            }
            ?>
        </section>



        </div>
    </div>
</div>
            <!-- Navigation Buttons -->
            <div class="slider-nav">
                <button onclick="prevSlide()">&#10094;</button>
                <button onclick="nextSlide()">&#10095;</button>
            </div>
        </div>
    </div>

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

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.form');
        const totalSlides = slides.length;

        function updateSliderPosition() {
            const sliderWrapper = document.querySelector('.slider-wrapper');
            sliderWrapper.style.transform = 'translateX(' + (-currentSlide * 100) + '%)';
        }

        function nextSlide() {
            if (currentSlide < totalSlides - 1) {
                currentSlide++;
                updateSliderPosition();
            }
        }

        function prevSlide() {
            if (currentSlide > 0) {
                currentSlide--;
                updateSliderPosition();
            }
        }
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let currentSlide = localStorage.getItem('currentSlide') ? parseInt(localStorage.getItem('currentSlide')) : 0;
            const slides = document.querySelectorAll('.form');
            const totalSlides = slides.length;

            // Function to update the slider position based on the current slide
            function updateSliderPosition() {
                const sliderWrapper = document.querySelector('.slider-wrapper');
                if (sliderWrapper) {
                    sliderWrapper.style.transform = 'translateX(' + (-currentSlide * 100) + '%)';
                } else {
                    console.error('Slider wrapper not found');
                }
            }

            // Move to the next slide
            function nextSlide() {
                if (currentSlide < totalSlides - 1) {
                    currentSlide++;
                    updateSliderPosition();
                    localStorage.setItem('currentSlide', currentSlide);  // Store the current slide index
                }
            }

            // Move to the previous slide
            function prevSlide() {
                if (currentSlide > 0) {
                    currentSlide--;
                    updateSliderPosition();
                    localStorage.setItem('currentSlide', currentSlide);  // Store the current slide index
                }
            }

            // Initialize the slider position when the page loads
            updateSliderPosition();  // Apply the correct position based on the stored slide index

            // Assign navigation buttons to functions
            document.querySelector('.slider-nav button:nth-child(1)').addEventListener('click', prevSlide);
            document.querySelector('.slider-nav button:nth-child(2)').addEventListener('click', nextSlide);
        });
    </script>



        <script src="clone.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script>
            AOS.init({
                duration: 1000,
                delay: 400
            });
        </script>
    </body>
</html>
