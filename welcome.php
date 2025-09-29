<?php
session_start();

// Check login via session OR cookie
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    echo "<p style='color:red;'>⚠️ No active session or cookie found. Redirecting...</p>";
    header("refresh:2;url=login.php");
    exit();
}

$username = $_SESSION['username'] ?? $_COOKIE['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h2>🎉 Welcome, <?php echo htmlspecialchars($username); ?>!</h2>

    <?php 
    if (isset($_SESSION['username'])) {
        echo "<p style='color:green;'>✅ Session is active for $username</p>";
    }
    if (isset($_COOKIE['username'])) {
        echo "<p style='color:blue;'>🍪 Cookie found for $username</p>";
    }
    ?>

    <a href="logout.php">Logout</a>
</body>
</html>
