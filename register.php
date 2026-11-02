
<?php

include "config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $fullname = trim($_POST["fullname"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Check if username or email already exists
    $check = mysqli_prepare($conn, 
        "SELECT id FROM users WHERE username = ? OR email = ?"
    );

    mysqli_stmt_bind_param($check, "ss", $username, $email);
    mysqli_stmt_execute($check);

    $result = mysqli_stmt_get_result($check);

    if (mysqli_num_rows($result) > 0) {

        $message = "Username or email already exists!";

    } else {

        // Encrypt password before saving
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into database
        $stmt = mysqli_prepare($conn,
            "INSERT INTO users (fullname, username, email, password)
             VALUES (?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $fullname,
            $username,
            $email,
            $hashed_password
        );

        if (mysqli_stmt_execute($stmt)) {
            $message = "Registration successful!";
        } else {
            $message = "Registration failed!";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_stmt_close($check);
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Register - Calisthenics</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="auth-page">

    <div class="auth-container">

        <div class="logo">
            CALI<span>STHENICS</span>
        </div>

        <h2>Create Account</h2>

        <p class="subtitle">
            Start your calisthenics journey today.
        </p>

        <p class="message">
            <?php echo htmlspecialchars($message); ?>
        </p>

        <form method="POST">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="fullname" required>
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="auth-button">
                REGISTER
            </button>

        </form>

        <p class="auth-link">
            Already have an account?
            <a href="login.php">Login here</a>
        </p>

    </div>

</body>
</html>
