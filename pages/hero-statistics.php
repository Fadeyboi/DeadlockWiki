<?php
$servername = "mysql.railway.internal";
$username = "root";
$password = "sFIdChKeMCCdhWvpFEUfWMjAlzoDAgkX";
$dbname = "railway";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT hero_name, hero_icon, winrate, pickrate, complexity, hero_page FROM hero_statistics";
$result = $conn->query($sql);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <title>Hero Statistics</title>
    <link rel="stylesheet" href="../global/print.css" media="print" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/png" href="../images/website-logo.png" />
    <link rel="stylesheet" href="../global/styles.css" />
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div id="main">
        <h1>Hero Statistics</h1>
        <table class="hero-stats-table">
            <caption>Hero Performance Metrics</caption>
            <thead>
                <tr>
                    <th>Hero Name and Icon</th>
                    <th>Average Winrate</th>
                    <th>Average Pickrate</th>
                    <th>Hero Complexity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>
                            <a href='" . htmlspecialchars($row['hero_page']) . "' style='text-decoration: none; color: inherit;'>
                                <img src='" . htmlspecialchars($row['hero_icon']) . "' alt='" . htmlspecialchars($row['hero_name']) . " Icon' class='hero-icon' />
                                <span>" . htmlspecialchars($row['hero_name']) . "</span>
                            </a>
                        </td>";
                        echo "<td>" . htmlspecialchars($row['winrate']) . "%</td>";
                        echo "<td>" . htmlspecialchars($row['pickrate']) . "%</td>";
                        echo "<td>" . htmlspecialchars($row['complexity']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data available</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>