<?php
if (!defined('BASE_URL')) {
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
  $host = $_SERVER['HTTP_HOST'];
  $path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
  define('BASE_URL', $protocol . '://' . $host . $path);
}

?>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>/images/website-logo.png" />
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/global/styles.css" />
</head>

<body>
  <header>
    <a href="<?php echo BASE_URL; ?>/pages/index.php">
      <img src="<?php echo BASE_URL; ?>/images/logo.png" alt="Deadlock Logo" class="logo" />
    </a>
    <!-- Navbar at the top with a dropdown list for picking a hero -->
    <nav>
      <ul>
        <li><a href="<?php echo BASE_URL; ?>/pages/index.php">Home</a></li>
        <li><a href="<?php echo BASE_URL; ?>/pages/services.php">Services</a></li>
        <li class="dropdown">
          <a href="<?php echo BASE_URL; ?>/pages/heroes/heroes.php" class="dropbtn">Heroes</a>
          <div class="dropdown-content">
            <a href="<?php echo BASE_URL; ?>/pages/heroes/heroes-abrams.php">Abrams</a>
            <a href="<?php echo BASE_URL; ?>/pages/heroes/heroes-bebop.php">Bebop</a>
            <a href="<?php echo BASE_URL; ?>/pages/heroes/heroes-dynamo.php">Dynamo</a>
            <a href="#">To be continued...</a>
          </div>
        </li>
        <li><a href="<?php echo BASE_URL; ?>/pages/heroes/hero-statistics.php">Hero Statistics</a></li>
        <li><a href="<?php echo BASE_URL; ?>/pages/heroes/hero-gallery.php">Hero Gallery</a></li>
      </ul>
    </nav>
  </header>
</body>