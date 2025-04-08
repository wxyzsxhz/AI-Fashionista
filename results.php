<?php
// Function to run the Prolog query and get recommendations
function getRecommendations($style, $ageGroup, $bodyType, $faceShape, $skinTone, $gender, $category)
{
    // Prepare the Prolog query to use recommend_clothing_min1 rule
    $query = "recommend_clothing_min1('$style', '$ageGroup', '$bodyType', '$faceShape', '$skinTone', '$gender', '$category').";

    // Prepare Prolog command
    $command = "\"C:/Program Files/swipl/bin/swipl.exe\" -s C:/xampp/htdocs/fashionista/example.pl -g \"$query\" -t halt.";

    // Execute Prolog command and capture the output
    $output = shell_exec($command);

    // Process the output to extract recommendations
    $recommendations = [];
    $lines = explode("\n", $output);

    foreach ($lines as $line) {
        if (preg_match('/Item: (.*), Image: (.*), Matches: (.*)/', $line, $matches)) {
            $item = trim($matches[1]);
            $imagePath = trim($matches[2]);
            $matchCount = (int) trim($matches[3]);

            // Add ageGroup, style, and gender to the match count
            $additionalMatches = 0;
            if ($ageGroup) $additionalMatches++;
            if ($style) $additionalMatches++;
            if ($gender) $additionalMatches++;

            // Adjust match count
            $totalMatches = $matchCount + $additionalMatches;

            // Add to recommendations array
            $recommendations[] = [
                'item' => $item,
                'image' => $imagePath,
                'matches' => $totalMatches
            ];
        }
    }

    // Sort the recommendations by number of matches in descending order
    usort($recommendations, function ($a, $b) {
        return $b['matches'] - $a['matches'];
    });

    return $recommendations;
}

// Handle the incoming form data
$recommendations = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all expected POST data is available
    $style = isset($_POST['style']) ? $_POST['style'] : '';
    $ageGroup = isset($_POST['age_group']) ? $_POST['age_group'] : '';
    $bodyType = isset($_POST['body_type']) ? $_POST['body_type'] : '';
    $faceShape = isset($_POST['face_shape']) ? $_POST['face_shape'] : '';
    $skinTone = isset($_POST['skin_tone']) ? $_POST['skin_tone'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';

    // Get recommendations if the fields are not empty
    if ($style && $ageGroup && $bodyType && $faceShape && $skinTone && $gender && $category) {
        $recommendations = getRecommendations($style, $ageGroup, $bodyType, $faceShape, $skinTone, $gender, $category);
    } else {
        echo '<p style="color: red;">Please fill in all the fields.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="#">
    <title>Fashion Recommendations</title>
    <link href="css/index.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <style>
        body {
            font-family: 'Cormorant Garamond', serif;
            background-color: #fde5ec;
            color: #5e435e;
            margin: 0;
            padding: 0;
        }


        h1 {
            font-size: 3em;
            text-align: center;
            color: #8c4872;
            margin: 30px 0;
            font-weight: bold;
            padding-top: 60px;
            position: relative;
        }

        h1::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background: #ec799a;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .recommendation-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            padding: 0 40px;
            margin: 40px auto;
            max-width: 1200px;
        }

        .recommendation-card {
            border: 3px solid #f1bfd4;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #fff3f8;
            position: relative;
            max-width: 300px;
            ;
        }

        .recommendation-card img {
            width: 100%;
            height: 110px;
            object-fit: cover;
            border-bottom: 2px solid #f1bfd4;
        }

        .recommendation-card:hover {
            transform: scale(1.08);
            box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.15);
        }

        .recommendation-info {
            padding: 20px;
            text-align: center;
            background-color: #fff;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            position: relative;
        }

        .recommendation-info p {
            margin: 0;
            font-size: 1.3em;
            font-weight: 600;
            color: #5e435e;
        }

        .recommendation-info .highly-recommended {
            display: block;
            margin-top: 10px;
            color: #ff97c5;
            font-weight: bold;
            font-size: 1.1em;
            position: relative;
        }

        .highly-recommended::before {
            content: '✨';
            position: absolute;
            left: -20px;
            animation: sparkle 1.5s infinite;
        }

        @keyframes sparkle {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }

            50% {
                opacity: 1;
                transform: scale(1);
            }

            100% {
                opacity: 0;
                transform: scale(0.8);
            }
        }


        .social-icons a {
            font-size: 2em;
            margin: 0 15px;
            color: #f291b8;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #ec799a;
        }
    </style>
</head>

<body>
    <header class="header">
        <a href="index.php" class="logo"> <img src="image/logo1.png" alt="" width="18%"> </a>

        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="personalized.php">Personalized</a>
            <a href="analysis.php">Analysis</a>
            <a href="about.php">About</a>
        </nav>
    </header>



    <h1>Fashion Recommendations Results</h1>
    <?php if (!empty($recommendations)): ?>
        <div class="recommendation-grid">
            <?php foreach ($recommendations as $rec): ?>
                <div class="recommendation-card">
                    <img
                        src="<?php echo htmlspecialchars($rec['image']); ?>"
                        alt="<?php echo htmlspecialchars($rec['item']); ?>"
                        style="<?php echo ($category === 'Set') ? 'height: 450px;' : 'height: 250px;'; ?>">
                    <div class="recommendation-info">
                        <p><?php echo htmlspecialchars($rec['item']); ?></p>
                        <?php if ($rec['matches'] > 6): ?>
                            <span class="highly-recommended">Highly recommended!</span>
                        <?php else: ?>
                            <p>Matches: <?php echo htmlspecialchars($rec['matches']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    <?php else: ?>
        <p style="text-align: center;">No recommendations found.</p>
    <?php endif; ?>

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