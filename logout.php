<?php
session_start();

// End session
if (isset($_SESSION['username'])) {
    $endedUser = $_SESSION['username'];
}
session_unset();
session_destroy();
$sessionMsg = "✅ Session destroyed.";

// Clear cookie
if (isset($_COOKIE['username'])) {
    $cookieUser = $_COOKIE['username'];
    setcookie("username", "", time() - 3600, "/");
    $cookieMsg = "🍪 Cookie cleared for user: $cookieUser";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
<body>
    <h2>Logout Successful</h2>

    <?php if (isset($endedUser)) echo "<p style='color:green;'>User '$endedUser' logged out.</p>"; ?>
    <?php if (isset($sessionMsg)) echo "<p style='color:red;'>$sessionMsg</p>"; ?>
    <?php if (isset($cookieMsg)) echo "<p style='color:blue;'>$cookieMsg</p>"; ?>

    <p>Redirecting to login page...</p>
    <?php header("refresh:3;url=login.php"); ?>
</body>
</html>
