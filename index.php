<?php
session_start();

// If user is already logged in via session or cookie, redirect to form.php
if (isset($_SESSION['email']) || isset($_COOKIE['email'])) {
    $_SESSION['email'] = $_COOKIE['email'];  // Restore session from cookie
    header("Location: form.php");
    exit();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } else {
        $domain = explode("@", $email)[1];  // Extract domain
        if ($password === $domain) {
            $_SESSION['email'] = $email;
            setcookie("email", $email, time() + (86400 * 30), "/");  // Save email for 30 days

            header("Location: form.php");
            exit();
        } else {
            $error = "Incorrect password! Password must match the email domain.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="index.css">

</head>
<body>
    <div class="login-container">
        <h2>LOGIN</h2>
        <hr class="line">
        <form method="POST">
            <div class="input-group">
                <input type="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="login-button">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
