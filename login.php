
<?php

session_start();

include "config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get login information
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Find the user
    $stmt = mysqli_prepare($conn,
        "SELECT id, fullname, username, password FROM users WHERE username = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user["password"])) {

            // Save user information in session
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["fullname"] = $user["fullname"];
            $_SESSION["username"] = $user["username"];

            header("Location: dashboard.php");
            exit();

        } else {
            $message = "Incorrect password!";
        }

    } else {
        $message = "Username not found!";
    }

    mysqli_stmt_close($stmt);
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login - Calisthenics</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="auth-page">

    <div class="auth-container">

        <div class="logo">
            CALI<span>STHENICS</span>
        </div>

        <h2>Welcome Back!</h2>

        <p class="subtitle">
            Continue your journey. Keep getting stronger.
        </p>

        <p class="message">
            <?php echo htmlspecialchars($message); ?>
        </p>

        <form method="POST">

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="auth-button">
                LOGIN
            </button>

        </form>

        <p class="auth-link">
            Don't have an account?
            <a href="register.php">Register here</a>
        </p>

    </div>

</body>
</html>

