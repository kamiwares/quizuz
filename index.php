<?php
session_start();
if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true) {
    $logged = $_SESSION['is_logged'];
    $name = $_SESSION['name'];
    $surname = $_SESSION['surname'];
    $userID = $_SESSION['userID'];
    $username = $_SESSION['username'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizuz</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/script.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php
    if (isset($logged)) {
        include(__DIR__.'/assets/navbar/navbaruser.php');
    } else {
        include(__DIR__.'/assets/navbar/navbar.php');
    }
    ?>
    <div class="section">
        <div class="container">
            <?php
            if (isset($logged)) {
                echo "Witaj " . $name . " " . $surname;
            }
            ?>
        </div>
    </div>

    <!-- Notification Error -->
    <?php
    if (isset($_GET['success'])) {
        echo '<div class="notification notification_succ">
            <div class="notification_body">
                <img
                    src="./img/icons/success.svg"
                    alt="Succes"
                    class="notification_icon"
                >
                Udało się! &#128640; 
            </div>
            <div class="notification_progress notification_progress_succ"></div>
        </div>';
    }
    if (isset($_GET['error'])) {
        echo '<div class="notification notification_err">
            <div class="notification_body">
                <img
                    src="./img/icons/error.svg"
                    alt="Succes"
                    class="notification_icon"
                >
                Wystąpił błąd! &#128557;
            </div>
            <div class="notification_progress notification_progress_err"></div>
        </div>';
    }
    ?>
</body>

</html>