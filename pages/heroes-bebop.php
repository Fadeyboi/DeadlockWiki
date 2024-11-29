<?php
// Database connection
$servername = "mysql.railway.internal";
$username = "root";
$password = "sFIdChKeMCCdhWvpFEUfWMjAlzoDAgkX";
$dbname = "railway";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Error connecting to the database.");
}

// Fetch hero data securely
$hero_name = 'Bebop';
$stmt = $conn->prepare("SELECT * FROM heroes WHERE name = ?");
$stmt->bind_param("s", $hero_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $hero = $result->fetch_assoc();
} else {
  die("Hero not found.");
}
?>

<!DOCTYPE html>
<html>

<head>
  <title><?php echo htmlspecialchars($hero['name']); ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="icon" type="image/png" href="../images/website-logo.png" />
  <link rel="stylesheet" href="../global/styles.css" />
</head>

<body>
  <?php include '../includes/header.php'; ?>
  <div id="main">
    <div class="hero-wiki">
      <div style="display: block;">
        <h1><?php echo htmlspecialchars($hero['name']); ?></h1>
        <h2>Abilities</h2>
        <div>
          <h3>
            <img src="../../images/bebop-ability-1.png" class="ability-icon" alt="Ability Icon" />
            <?php echo htmlspecialchars($hero['ability1_name']); ?>
          </h3>
          <p><?php echo htmlspecialchars($hero['ability1_desc']); ?></p>
        </div>
        <div>
          <h3>
            <img src="../../images/bebop-ability-2.png" class="ability-icon" alt="Ability Icon" />
            <?php echo htmlspecialchars($hero['ability2_name']); ?>
          </h3>
          <p><?php echo htmlspecialchars($hero['ability2_desc']); ?></p>
        </div>
        <div>
          <h3>
            <img src="../../images/bebop-ability-3.png" class="ability-icon" alt="Ability Icon" />
            <?php echo htmlspecialchars($hero['ability3_name']); ?>
          </h3>
          <p><?php echo htmlspecialchars($hero['ability3_desc']); ?></p>
        </div>
        <div>
          <h3>
            <img src="../../images/bebop-ability-4.png" class="ability-icon" alt="Ability Icon" />
            <?php echo htmlspecialchars($hero['ability4_name']); ?>
          </h3>
          <p><?php echo htmlspecialchars($hero['ability4_desc']); ?></p>
        </div>
      </div>

      <div class="hero-wiki-figure">
        <img class="figure-img" src="../../images/bebop-icon.png" alt="bebop Icon" />
        <div class="figure-caption"><?php echo htmlspecialchars($hero['name']); ?></div>
      </div>
    </div>
    <div>
      <h2>Basic Combo</h2>
      <video width="560" height="315" controls>
        <source src="<?php echo htmlspecialchars($hero['combo_video']); ?>" type="video/mp4" />
        <p>Your browser does not support the video tag. You can <a href="<?php echo htmlspecialchars($hero['combo_video']); ?>">download the video</a> instead.</p>
      </video>
    </div>
    <div>
      <h2>Lore</h2>
      <p><?php echo htmlspecialchars($hero['lore']); ?></p>
    </div>
  </div>
  <?php include '../includes/footer.php'; ?>
</body>

</html>
<?php
$stmt->close();
$conn->close();
?>