<?php
include '../includes/header.php';

// Database connection
$servername = "mysql.railway.internal";
$username = "root";
$password = "sFIdChKeMCCdhWvpFEUfWMjAlzoDAgkX";
$dbname = "railway";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reviews
$sql = "SELECT r.id, r.name, r.email, r.favorite_hero, r.rating, r.feedback, r.recommend, r.server, h.name as hero_name 
        FROM reviews r
        LEFT JOIN heroes h ON r.hero_id = h.id
        ORDER BY r.id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <title>View Reviews</title>
</head>

<body>
    <main>
        <h1>User Reviews</h1>
        <?php if ($result && $result->num_rows > 0): ?>
            <table class="reviews-table">
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
                            <td><?php echo htmlspecialchars($row['hero_name'] ?? $row['favorite_hero']); ?></td>
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
    </main>
    <?php include '../includes/footer.php'; ?>
</body>

</html>
<?php $conn->close(); ?>