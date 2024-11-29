<!-- Name: Fahd Adel Alghamdi -->
<!-- ID: 2135938 -->
<!-- Section: CS1 -->
<!-- Date: 9/22/2024 -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <title>Hero Reviews</title>
    <link rel="stylesheet" href="../CSS/styles.css" />
    <script src="../scripts/validation.js" type="text/javascript"></script>
</head>

<?php include '../includes/header.php'; ?>

<body>
    <main>
        <h1>Hero Reviews</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "mysql.railway.internal";
            $username = "root";
            $password = "sFIdChKeMCCdhWvpFEUfWMjAlzoDAgkX";
            $dbname = "railway";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("<p>Error connecting to the database: " . $conn->connect_error . "</p>");
            }
            $name = $conn->real_escape_string($_POST['name']);
            $email = $conn->real_escape_string($_POST['email']);
            $age = $conn->real_escape_string($_POST['age']);
            $favorite_hero = $conn->real_escape_string($_POST['favorite_hero']);
            $rating = $conn->real_escape_string($_POST['rating']);
            $recommend = isset($_POST['recommend']) ? 'Yes' : 'No';
            $difficult = isset($_POST['difficult']) ? 'Yes' : 'No';
            $gender = $conn->real_escape_string($_POST['gender']);
            $server = $conn->real_escape_string($_POST['server']);
            $feedback = $conn->real_escape_string($_POST['feedback']);

            $sql = "SELECT email FROM reviews WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<p style='color: red;'>This email has already been used to submit a review.</p>";
            } else {
                $sql = "INSERT INTO reviews (name, email, age, favorite_hero, rating, recommend, difficult, gender, server, feedback)
                VALUES ('$name', '$email', '$age', '$favorite_hero', '$rating', '$recommend', '$difficult', '$gender', '$server', '$feedback')";

                if ($conn->query($sql) === TRUE) {
                    echo "<p style='color: green;'>Thank you for your review!</p>";
                } else {
                    echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
                }
            }
            $conn->close();
        }
        ?>

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
                    <option value="Other">Other</option>
                </select>
            </fieldset>

            <!-- Review Section -->
            <fieldset>
                <legend>Hero Review</legend>

                <label for="favorite_hero">Favorite Hero: *</label>
                <input type="text" id="favorite_hero" name="favorite_hero" required="required" />

                <label>Rating: *</label>
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

                <label>Would you recommend this hero to others?</label>
                <input type="checkbox" id="recommend" name="recommend" value="Yes" />
                <label for="recommend">Yes</label>

                <label>Is this hero difficult to play?</label>
                <input type="checkbox" id="difficult" name="difficult" value="Yes" />
                <label for="difficult">Yes</label>

                <label for="Server">Which Server do you play on? *</label>
                <select id="Server" name="Server" required="required">
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
    </main>

    <?php include '../includes/footer.php'; ?>
</body>

</html>