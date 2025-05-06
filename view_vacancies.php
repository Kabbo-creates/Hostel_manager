<?php
session_start();
require 'db.php';

// if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'Bachelor') {
//     header("Location: index.html");
//     exit();
// }

$username = $_SESSION['username'];

$query = $conn->prepare("SELECT * FROM vacancies");
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Posted Vacancies</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f8ff; padding: 20px; }
        h2 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #007BFF; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .back { margin-top: 20px; display: inline-block; color: #007BFF; text-decoration: none; }
    </style>
</head>
<body>

<h2>Posted Vacancies</h2>

<table>
    <tr>
        <th>Location</th>
        <th>Monthly Rent</th>
        <th>No. of Seats</th>
        <th>Posted On</th>
        <th>Posted By</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['location']) ?></td>
        <td><?= htmlspecialchars($row['rent']) ?></td>
        <td><?= htmlspecialchars($row['seats_available']) ?></td>
        <td><?= date("d M Y", strtotime($row['created_at'])) ?></td>
        <td><?php echo htmlspecialchars($row['bachelor_username']); ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<a class="back" href="home.php">← Back to Home</a>

</body>
</html>
