<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "mysql.railway.internal";
    $username = "root";
    $password = "sFIdChKeMCCdhWvpFEUfWMjAlzoDAgkX";
    $dbname = "railway";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error connecting to the database.");
    }

    // Prepare and sanitize inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $favorite_hero = filter_input(INPUT_POST, 'favorite_hero', FILTER_SANITIZE_STRING);
    $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
    $recommend = isset($_POST['recommend']) ? 'Yes' : 'No';
    $difficult = isset($_POST['difficult']) ? 'Yes' : 'No';
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $server = filter_input(INPUT_POST, 'server', FILTER_SANITIZE_STRING);
    $feedback = htmlspecialchars($_POST['feedback']);

    if (!$name || !$email || !$age || !$favorite_hero || !$rating || !$gender || !$server || !$feedback) {
        echo "<p style='color:red;'>Invalid input. Please check your entries and try again.</p>";
        exit;
    }

    // Use prepared statements to fetch hero_id
    $stmt = $conn->prepare("SELECT id FROM heroes WHERE LOWER(name) = LOWER(?)");
    $stmt->bind_param("s", $favorite_hero);
    $stmt->execute();
    $result = $stmt->get_result();
    $hero_id = $result->num_rows > 0 ? $result->fetch_assoc()['id'] : null;

    if (!$hero_id) {
        echo "<p style='color:red;'>Hero not found. Please try again.</p>";
        exit;
    }

    // Check for duplicate email
    $stmt = $conn->prepare("SELECT email FROM reviews WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<p style='color:red;'>This email has already been used to submit a review.</p>";
    } else {
        // Insert the review
        $stmt = $conn->prepare("INSERT INTO reviews (hero_id, name, email, age, rating, recommend, difficult, gender, server, feedback) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssisssss", $hero_id, $name, $email, $age, $rating, $recommend, $difficult, $gender, $server, $feedback);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>Thank you for your review!</p>";
        } else {
            echo "<p>Error: Unable to submit your review. Please try again later.</p>";
        }
    }

    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <title>Hero Reviews</title>
    <script src="../scripts/validation.js" type="text/javascript"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/png" href="../images/website-logo.png" />
    <link rel="stylesheet" href="../global/styles.css" />
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div id="main">
        <h1>Post a Review</h1>
        <form id="reviewForm" action="hero-review.php" method="post" onsubmit="return validateForm();">
            <fieldset>
                <legend>Personal Information</legend>

                <label for="name">Name: *</label>
                <input type="text" id="name" name="name" required="required" />

                <label for="email">Email: *</label>
                <input type="email" id="email" name="email" required="required" />

                <label for="age">Age: *</label>
                <input type="number" id="age" name="age" min="1" max="120" required="required" />

                <label for="gender">Gender: *</label>
                <select id="gender" name="gender" required="required">
                    <option value="">--Select Gender--</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Rather Not Say</option>
                </select>
            </fieldset>

            <!-- Review Section -->
            <fieldset>
                <legend>Hero Review</legend>

                <label for="favorite_hero">Favorite Hero: *</label>
                <input type="text" id="favorite_hero" name="favorite_hero" required="required" />


                <label>Rate the hero out of 5: *</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input type="radio" id="rating1" name="rating" value="1" required="required" />
                    <label for="rating1">1</label>

                    <input type="radio" id="rating2" name="rating" value="2" />
                    <label for="rating2">2</label>

                    <input type="radio" id="rating3" name="rating" value="3" />
                    <label for="rating3">3</label>

                    <input type="radio" id="rating4" name="rating" value="4" />
                    <label for="rating4">4</label>

                    <input type="radio" id="rating5" name="rating" value="5" />
                    <label for="rating5">5</label>
                </div>


                <label>Would you recommend this hero to others?</label>
                <input type="checkbox" id="recommend" name="recommend" value="Yes" />
                <label for="recommend">Yes</label>

                <label>Is this hero difficult to play?</label>
                <input type="checkbox" id="difficult" name="difficult" value="Yes" />
                <label for="difficult">Yes</label>

                <label for="server">Which Server do you play on? *</label>
                <select id="server" name="server" required="required">
                    <option value="">--Select Server--</option>
                    <option value="NA">NA</option>
                    <option value="EU">EU</option>
                    <option value="Asia">Asia</option>
                </select>

                <label for="feedback">Feedback: *</label>
                <textarea id="feedback" name="feedback" rows="5" cols="50" required="required"></textarea>
            </fieldset>

            <input type="submit" value="Submit Review" />
        </form>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>