<?php
include '../includes/header.php';

// Database connection
$servername = "mysql.railway.internal";
$username = "root";
$password = "your_password";
$dbname = "railway";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve hero data
$hero_name = 'Abrams';
$sql = "SELECT * FROM heroes WHERE name = '$hero_name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $hero = $result->fetch_assoc();
} else {
  die("Hero not found.");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
  <title><?php echo htmlspecialchars($hero['name']); ?></title>
</head>

<body>
  <main>
    <div class="hero-wiki">
      <h1><?php echo htmlspecialchars($hero['name']); ?></h1>
      <h2>Abilities</h2>
      <div>
        <h3><?php echo htmlspecialchars($hero['ability1_name']); ?></h3>
        <p><?php echo htmlspecialchars($hero['ability1_desc']); ?></p>
      </div>
      <div>
        <h3><?php echo htmlspecialchars($hero['ability2_name']); ?></h3>
        <p><?php echo htmlspecialchars($hero['ability2_desc']); ?></p>
      </div>
      <div>
        <h3><?php echo htmlspecialchars($hero['ability3_name']); ?></h3>
        <p><?php echo htmlspecialchars($hero['ability3_desc']); ?></p>
      </div>
      <div>
        <h3><?php echo htmlspecialchars($hero['ability4_name']); ?></h3>
        <p><?php echo htmlspecialchars($hero['ability4_desc']); ?></p>
      </div>
      <h2>Basic Combo</h2>
      <video width="560" height="315" controls>
        <source src="<?php echo htmlspecialchars($hero['combo_video']); ?>" type="video/mp4" />
        <p>Your browser does not support the video tag. You can <a href="<?php echo htmlspecialchars($hero['combo_video']); ?>">download the video</a> instead.</p>
      </video>
      <h2>Lore</h2>
      <p><?php echo htmlspecialchars($hero['lore']); ?></p>
    </div>
  </main>
  <?php include '../includes/footer.php'; ?>
</body>

</html>