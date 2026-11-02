
<?php

session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit();
}

// Redirect new visitors to registration
header("Location: register.php");
exit();

?>
