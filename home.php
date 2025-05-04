<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$username = $_SESSION['username'];

// Get user type from DB
$stmt = $conn->prepare("SELECT user_type FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$user_type = $row['user_type'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #80deea);
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #006064;
            color: white;
        }

        .welcome {
            font-size: 20px;
            font-weight: bold;
        }

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            background-color: #d32f2f;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #b71c1c;
        }

        .main {
            text-align: center;
            margin-top: 100px;
        }

        .action-btn {
            background-color: #00796b;
            color: white;
            padding: 15px 30px;
            margin: 10px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }

        .action-btn:hover {
            background-color: #004d40;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="welcome">Welcome, <?php echo htmlspecialchars($username); ?>!</div>
        <form class="logout-form" action="logout.php" method="post">
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    </div>

    <div class="main">

        <button class="action-btn" onclick="window.location.href='profile.php'">Manage Profile</button>

        <?php if ($user_type === "Owner"): ?>
            <button class="action-btn" onclick="window.location.href='add_property.php'">Add Property</button>
            <button class="action-btn" onclick="window.location.href='view_properties.php'">View Posted Properties</button>
        <?php elseif ($user_type === "Bachelor"): ?>
            <button class="action-btn" onclick="window.location.href='properties_ad.php'">Properties Ad</button>
            <button class="action-btn" onclick="window.location.href='post_vacancy.php'">Post Vacancy</button>
        <?php endif; ?>
    </div>

</body>
</html>
