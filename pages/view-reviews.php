<?php
$servername = "mysql.railway.internal";
$username = "root";
$password = "sFIdChKeMCCdhWvpFEUfWMjAlzoDAgkX";
$dbname = "railway";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error connecting to the database.");
}

$sql = "SELECT r.id, r.name, r.email, h.name AS hero_name, r.rating, r.recommend, r.server, r.feedback
        FROM reviews r
        LEFT JOIN heroes h ON r.hero_id = h.id
        ORDER BY r.id DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>

<head>
    <title>View Reviews</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/png" href="../images/website-logo.png" />
    <link rel="stylesheet" href="../global/styles.css" />
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div id="main">
        <h1>User Reviews</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Favorite Hero</th>
                        <th>Rating</th>
                        <th>Recommend</th>
                        <th>Server</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['hero_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['rating']); ?></td>
                            <td><?php echo htmlspecialchars($row['recommend']); ?></td>
                            <td><?php echo htmlspecialchars($row['server']); ?></td>
                            <td><?php echo htmlspecialchars($row['feedback']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No reviews found.</p>
        <?php endif; ?>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>
<?php $stmt->close();
$conn->close(); ?>