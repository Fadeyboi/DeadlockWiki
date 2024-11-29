<?php
$servername = "mysql.railway.internal";
$username = "root";
$password = "sFIdChKeMCCdhWvpFEUfWMjAlzoDAgkX";
$dbname = "railway";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error connecting to the database.");
}

$sql = "SELECT r.id, r.name, r.email, h.name AS hero_name, r.rating, r.recommend, r.server, r.feedback, r.difficult
        FROM reviews r
        LEFT JOIN heroes h ON r.hero_id = h.id
        ORDER BY r.id DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <title>View Reviews</title>
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
                        <th>Difficult</th>
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
                            <td><?php echo htmlspecialchars($row['difficult']); ?></td>
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
<?php
$stmt->close();
$conn->close();
?>