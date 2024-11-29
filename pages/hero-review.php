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
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $favorite_hero = htmlspecialchars($_POST['favorite_hero'], ENT_QUOTES, 'UTF-8');
    $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
    $recommend = isset($_POST['recommend']) ? 'Yes' : 'No';
    $difficult = isset($_POST['difficult']) ? 'Yes' : 'No';
    $gender = htmlspecialchars($_POST['gender'], ENT_QUOTES, 'UTF-8');
    $server = htmlspecialchars($_POST['server'], ENT_QUOTES, 'UTF-8');
    $feedback = htmlspecialchars($_POST['feedback'], ENT_QUOTES, 'UTF-8');

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
        $stmt = $conn->prepare("INSERT INTO reviews (hero_id, favorite_hero, name, email, age, rating, recommend, difficult, gender, server, feedback) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssissssss", $hero_id, $favorite_hero, $name, $email, $age, $rating, $recommend, $difficult, $gender, $server, $feedback);


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
    <title>Post a Review</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/png" href="../images/website-logo.png" />
    <link rel="stylesheet" href="../global/styles.css" />
    <script type="text/javascript">
        // <![CDATA[
        function validateForm() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var age = document.getElementById('age').value;
            var feedback = document.getElementById('feedback').value;

            if (!name || !email || !age || !feedback) {
                alert('All fields marked with * are required.');
                return false;
            }
            var emailRegex = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return false;
            }
            var ageNumber = parseInt(age, 10);
            if (isNaN(ageNumber) || ageNumber < 1 || ageNumber > 120) {
                alert('Please enter a valid age between 1 and 120.');
                return false;
            }
            return true;
        }
        // ]]>
    </script>


</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div id="main">
        <h1>Post a Review</h1>
        <form id="reviewForm" action="hero-review.php" method="post" onsubmit="return validateForm();">
            <fieldset>
                <legend>Personal Information</legend>
                <p>
                    <label for="name">Name: *</label>
                    <input type="text" id="name" name="name" />
                </p>
                <p>
                    <label for="email">Email: *</label>
                    <input type="text" id="email" name="email" />
                </p>
                <p>
                    <label for="age">Age: *</label>
                    <input type="text" id="age" name="age" />
                </p>
                <p>
                    <label for="gender">Gender: *</label>
                    <select id="gender" name="gender">
                        <option value="">--Select Gender--</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Rather Not Say</option>
                    </select>
                </p>
            </fieldset>
            <fieldset>
                <legend>Hero Review</legend>
                <p>
                    <label for="favorite_hero">Favorite Hero: *</label>
                    <input type="text" id="favorite_hero" name="favorite_hero" />
                </p>
                <p>
                    <label>Rate the hero out of 5: *</label>
                    <span>
                        <input type="radio" id="rating1" name="rating" value="1" />
                        <label for="rating1">1</label>
                        <input type="radio" id="rating2" name="rating" value="2" />
                        <label for="rating2">2</label>
                        <input type="radio" id="rating3" name="rating" value="3" />
                        <label for="rating3">3</label>
                        <input type="radio" id="rating4" name="rating" value="4" />
                        <label for="rating4">4</label>
                        <input type="radio" id="rating5" name="rating" value="5" />
                        <label for="rating5">5</label>
                    </span>
                </p>
                <p>
                    <label>Would you recommend this hero to others?</label>
                    <input type="checkbox" id="recommend" name="recommend" value="Yes" />
                </p>
                <p>
                    <label>Is this hero difficult to play?</label>
                    <input type="checkbox" id="difficult" name="difficult" value="Yes" />
                </p>
                <p>
                    <label for="server">Which Server do you play on? *</label>
                    <select id="server" name="server">
                        <option value="">--Select Server--</option>
                        <option value="NA">NA</option>
                        <option value="EU">EU</option>
                        <option value="Asia">Asia</option>
                    </select>
                </p>
                <p>
                    <label for="feedback">Feedback: *</label>
                    <textarea id="feedback" name="feedback" rows="5" cols="50"></textarea>
                </p>
            </fieldset>
            <p>
                <input type="submit" value="Submit Review" />
            </p>
        </form>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>