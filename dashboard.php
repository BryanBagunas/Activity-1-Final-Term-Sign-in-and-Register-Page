
<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Calisthenics</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="dashboard-page">

    <div class="dashboard-content">

        <h1>
            Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!
        </h1>

        <h2>Your journey starts now.</h2>

        <p>
            Build your strength.<br>
            Master your body.<br>
            Develop your static skills.
        </p>

        <a href="logout.php" class="logout-button">
            LOGOUT
        </a>

    </div>

</body>
</html>
