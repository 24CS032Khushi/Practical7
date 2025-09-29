<?php 
session_start();

// Hardcoded credentials (for testing/demo)
$users = [
    "admin" => "12345",
    "student" => "abcde"
];

// Handle login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    if (isset($users[$username]) && $users[$username] === $password) {
        // Start session
        $_SESSION['username'] = $username;

        // Set cookie if "Remember Me" checked
        if ($remember) {
            setcookie("username", $username, time() + (86400 * 7), "/"); // 7 days
            $cookieMsg = "Cookie set for user: $username";
        }

        $success = "✅ Session started for user: $username";
        header("refresh:2;url=welcome.php"); // Redirect after 2 seconds
    } else {
        $error = "❌ Invalid username or password.";
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

    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($cookieMsg)) echo "<p style='color:blue;'>$cookieMsg</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        
        <label><input type="checkbox" name="remember"> Remember Me</label><br><br>
        
        <input type="submit" value="Login">
    </form>
</body>
</html>
