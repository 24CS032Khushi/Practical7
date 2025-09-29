<?php
session_start();

// Hardcoded credentials (for testing)
$users = [
    "admin" => "12345",
    "student" => "abcde"
];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    if (isset($users[$username]) && $users[$username] === $password) {
        // Store session
        $_SESSION['username'] = $username;

        // Remember Me using cookies
        if ($remember) {
            setcookie("username", $username, time() + (86400 * 7), "/"); // 7 days
        }

        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login System</title>
</head>
<body>
    <h2>Login Page</h2>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <label><input type="checkbox" name="remember"> Remember Me</label><br><br>
        <input type="submit" value="Login">
    </form>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
